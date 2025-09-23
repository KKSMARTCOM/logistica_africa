<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $values = Value::latest()->paginate(10);

        return view('apps.pages.backend.values.index', compact('values'));
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ], [
            'title.required' => 'Le titre est obligatoire.',
            'title.string' => 'Le titre doit être une chaîne de caractères.',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',

            'description.required' => 'La description est obligatoire.',
            'description.string' => 'La description doit être une chaîne de caractères.',

            'status.boolean' => 'Le statut doit être valide.',

            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format : jpeg, png, jpg, gif ou webp.',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            return redirect()->back()
                ->with('error', $firstErrorMessage);
        }

        try {
            $data = $request->only(['title', 'description', 'status']);

            if ($request->hasFile('image')) {
                $img = $request->file('image');
                $folderName = $request->title;
                $uploadFolder = 'assets/images/values/';
                folderOpen($uploadFolder);
                $imgurl = uploadImage($img, $folderName, $uploadFolder);

                $data['image'] = $imgurl;
            }

            Value::create($data);

            return redirect()->back()->with('success', 'Valeur ajoutée avec succès !');
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ], [
            'title.required' => 'Le Titre est obligatoire.',
            'title.string' => 'Le Titre doit être une chaîne de caractères.',
            'title.max' => 'Le Titre ne peut pas dépasser 255 caractères.',

            'description.required' => 'La description est obligatoire.',
            'description.string' => 'La description doit être une chaîne de caractères.',

            'status.boolean' => 'Le statut doit être valide.',

            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format : jpeg, png, jpg, gif ou webp.',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            return redirect()->back()
                ->with('error', $firstErrorMessage);
        }

        try {
            $value = Value::findOrFail($id);

            $data = $request->only(['title', 'description', 'status']);

            if ($request->hasFile('image')) {
                if ($value->image) {
                    deleteFile($value->image);
                }

                $img = $request->file('image');
                $folderName = $request->title;
                $uploadFolder = 'assets/images/values/';
                folderOpen($uploadFolder);
                $imgurl = uploadImage($img, $folderName, $uploadFolder);

                $data['image'] = $imgurl;
            }

            $value->update($data);

            return redirect()->back()->with('success', 'Valeur modifiée avec succès !');
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
            $value = Value::findOrFail($id);

            // Supprimer l'image si elle existe
            if ($value->image) {
                deleteFile($value->image);
            }

            // Suppression du post
            $value->delete();

            return redirect()->back()->with('success', 'La valeur a été supprimé avec succès.');
        } catch (\Throwable $e) {
            Log::error('Erreur lors de la suppression : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
}
