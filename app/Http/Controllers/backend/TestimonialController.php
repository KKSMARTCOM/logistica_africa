<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $backTestimonials = Testimonial::latest()->paginate(10);

        return view('apps.pages.backend.testimonials.index', compact('backTestimonials'));
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',

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
            $data = $request->only(['name', 'description', 'status']);

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('testimonials', 'public');
            }

            Testimonial::create($data);

            return redirect()->back()->with('success', 'Témoignage ajouté avec succès !');
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',

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
            $testimonial = Testimonial::findOrFail($id);

            $data = $request->only(['name', 'description', 'status']);

            if ($request->hasFile('image')) {
                if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                    Storage::disk('public')->delete($testimonial->image);
                }

                $data['image'] = $request->file('image')->store('testimonials', 'public');
            }

            $testimonial->update($data);

            return redirect()->back()->with('success', 'Témoignage modifié avec succès !');
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
            $testimonial = Testimonial::findOrFail($id);

            // Supprimer l'image si elle existe
            if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }

            // Suppression du post
            $testimonial->delete();

            return redirect()->back()->with('success', 'Le témoignage a été supprimé avec succès.');
        } catch (\Throwable $e) {
            Log::error('Erreur lors de la suppression : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
}
