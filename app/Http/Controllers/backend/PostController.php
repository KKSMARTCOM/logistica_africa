<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();

        $breadcrumb = [
            'label' => 'Liste des actualités',
            'link' => '/'
        ];

        return view('apps.pages.backend.posts.index', compact('posts', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('apps.pages.backend.posts.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50',
            'status' => 'required|in:archive,publish,draft',
        ], [
            'title.required' => 'Le titre est obligatoire.',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'content.required' => 'Le contenu est obligatoire.',
            'cover_image.image' => "Le fichier doit être une image valide.",
            'cover_image.mimes' => "Les formats d'image autorisés : jpeg, png, jpg, gif, webp.",
            'cover_image.max' => "La taille de l'image ne doit pas dépasser 2 Mo.",
            'tags.array' => "Les tags doivent être un tableau.",
            'tags.*.max' => "Chaque tag ne doit pas dépasser 50 caractères.",
            'status.required' => 'Le statut est obligatoire.',
            'status.in' => 'Le statut doit être draft, publish ou archive.',
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            return redirect()->back()
                ->with('error', $firstErrorMessage);
        }

        try {
            $data = $request->only(['title', 'content', 'status', 'tags']);

            if ($request->hasFile('cover_image')) {
                $data['cover_image'] = $request->file('cover_image')->store('posts', 'public');
            }

            $data['tags'] = $request->tags ? json_encode($request->tags) : null;

            $wordCount = str_word_count(strip_tags($request->content));
            $data['estimated_reading_time'] = max(1, ceil($wordCount / 200));

            Post::create($data);

            return redirect()->route('panel.posts.index')->with('success', 'Article ajouté avec succès !');
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
        $post = Post::findOrFail($id);

        return view('apps.pages.backend.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50',
            'status' => 'required|in:archive,publish,draft',
        ], [
            'title.required' => 'Le titre est obligatoire.',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'content.required' => 'Le contenu est obligatoire.',
            'cover_image.image' => "Le fichier doit être une image valide.",
            'cover_image.mimes' => "Les formats d'image autorisés : jpeg, png, jpg, gif, webp.",
            'cover_image.max' => "La taille de l'image ne doit pas dépasser 2 Mo.",
            'tags.array' => "Les tags doivent être un tableau.",
            'tags.*.max' => "Chaque tag ne doit pas dépasser 50 caractères.",
            'status.required' => 'Le statut est obligatoire.',
            'status.in' => 'Le statut doit être draft, publish ou archive.',
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            return redirect()->back()
                ->with('error', $firstErrorMessage);
        }

        try {
            $data = $request->only(['title', 'content', 'status', 'tags']);

            // Gestion de l'image
            if ($request->hasFile('cover_image')) {
                // Supprimer l'ancienne image si elle existe
                if ($post->cover_image && Storage::disk('public')->exists($post->cover_image)) {
                    Storage::disk('public')->delete($post->cover_image);
                }
                $data['cover_image'] = $request->file('cover_image')->store('posts', 'public');
            }

            // Gestion des tags
            $data['tags'] = $request->tags ? json_encode($request->tags) : null;

            // Calcul du temps de lecture (200 mots/min)
            $wordCount = str_word_count(strip_tags($request->content));
            $data['estimated_reading_time'] = max(1, ceil($wordCount / 200));

            // Mise à jour du post
            $post->update($data);

            return redirect()->route('panel.posts.index')->with('success', 'Article mise à jour avec succès !');
        } catch (\Throwable $e) {
            dd($e);
            Log::error('Erreur lors de la mise à jour : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue. Veuillez réessayer.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $post = Post::findOrFail($id);

            // Supprimer l'image si elle existe
            if ($post->cover_image && Storage::disk('public')->exists($post->cover_image)) {
                Storage::disk('public')->delete($post->cover_image);
            }

            // Suppression du post
            $post->delete();

            return redirect()->back()->with('success', 'L\'article a été supprimée avec succès.');
        } catch (\Throwable $e) {
            Log::error('Erreur lors de la suppression : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
}
