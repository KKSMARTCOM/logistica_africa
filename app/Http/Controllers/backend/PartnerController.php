<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::latest()->paginate(10);

        return view('apps.pages.backend.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => ['required', 'string', 'max:255'],
            'image'       => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'website_url' => ['nullable', 'url'],
            'status'      => ['required', 'boolean'],
        ], [
            'name.required'        => 'Le nom est obligatoire.',
            'name.string'          => 'Le nom doit être une chaîne de caractères.',
            'name.max'             => 'Le nom ne doit pas dépasser 255 caractères.',

            'image.required'       => 'L’image principale est obligatoire.',
            'image.image'          => 'Le fichier doit être une image.',
            'image.mimes'          => 'L’image doit être au format jpg, jpeg, png ou webp.',
            'image.max'            => 'L’image ne doit pas dépasser 2 Mo.',

            'website_url.url'      => 'L’URL du site web doit être une adresse valide.',

            'status.required'      => 'Le statut est obligatoire.',
            'status.boolean'       => 'Le statut doit être vrai ou faux.',
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            return redirect()->back()
                ->with('error', $firstErrorMessage);
        }

        try {
            $data = $request->only(['name', 'website_url', 'status']);

            if ($request->hasFile('image')) {
                $img = $request->file('image');
                $folderName = $request->name;
                $uploadFolder = 'assets/images/partners/';
                folderOpen($uploadFolder);
                $imgurl = uploadImage($img, $folderName, $uploadFolder);

                $data['image'] = $imgurl;
            }

            Partner::create($data);

            return redirect()->back()->with('success', 'Partenaire ajouté avec succès !');
        } catch (\Throwable $e) {
            dd($e);
            Log::error('Erreur lors de l\'ajout : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'ajout. Veuillez reéssayer.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name'        => ['required', 'string', 'max:255'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'website_url' => ['nullable', 'url'],
            'status'      => ['required', 'boolean'],
        ], [
            'name.required'        => 'Le nom est obligatoire.',
            'name.string'          => 'Le nom doit être une chaîne de caractères.',
            'name.max'             => 'Le nom ne doit pas dépasser 255 caractères.',

            'image.image'          => 'Le fichier doit être une image.',
            'image.mimes'          => 'L’image doit être au format jpg, jpeg, png ou webp.',
            'image.max'            => 'L’image ne doit pas dépasser 2 Mo.',

            'website_url.url'      => 'L’URL du site web doit être une adresse valide.',

            'status.required'      => 'Le statut est obligatoire.',
            'status.boolean'       => 'Le statut doit être vrai ou faux.',
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            return redirect()->back()
                ->with('error', $firstErrorMessage);
        }

        try {
            $partner = Partner::findOrFail($id);

            $data = $request->only(['name', 'website_url', 'status']);

            if ($request->hasFile('image')) {
                if ($partner->image) {
                    deleteFile($partner->image);
                }

                $img = $request->file('image');
                $folderName = $request->name;
                $uploadFolder = 'assets/images/partners/';
                folderOpen($uploadFolder);
                $imgurl = uploadImage($img, $folderName, $uploadFolder);

                $data['image'] = $imgurl;
            }

            $partner->update($data);

            return redirect()->back()->with('success', 'Partenaire modifié avec succès !');
        } catch (\Throwable $e) {
            dd($e);
            Log::error('Erreur lors de la modification : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la modification. Veuillez reéssayer.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $partner = Partner::findOrFail($id);

            // Supprimer l'image si elle existe
            if ($partner->image) {
                deleteFile($partner->image);
            }

            // Suppression du post
            $partner->delete();

            return redirect()->back()->with('success', 'Le Partenaire a été supprimé avec succès.');
        } catch (\Throwable $e) {
            Log::error('Erreur lors de la suppression : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
}
