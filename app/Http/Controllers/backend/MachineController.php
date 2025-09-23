<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $machines = Machine::latest()->paginate(10);
        $categories = Category::all();

        return view('apps.pages.backend.machines.index', compact('machines', 'categories'));
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'additionnel_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'characteristics' => 'nullable|array',
            'characteristics.*.label' => 'required_with:characteristics.*.value|string|max:255',
            'characteristics.*.value' => 'required_with:characteristics.*.label|string|max:255',
        ], [
            'name.required' => 'Le nom de la machine est obligatoire.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'category_id.required' => 'La catégorie est obligatoire.',
            'category_id.exists' => 'La catégorie sélectionnée est invalide.',
            'price.required' => 'Le prix est obligatoire.',
            'price.integer' => 'Le prix doit être un nombre entier.',
            'price.min' => 'Le prix doit être supérieur ou égal à 0.',
            'image.required' => 'L’image principale est obligatoire.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L’image doit être au format jpg, jpeg, png ou webp.',
            'image.max' => 'L’image ne doit pas dépasser 2Mo.',
            'additionnel_images.*.image' => 'Chaque fichier additionnel doit être une image.',
            'additionnel_images.*.mimes' => 'Chaque image additionnelle doit être au format jpg, jpeg, png ou webp.',
            'additionnel_images.*.max' => 'Chaque image additionnelle ne doit pas dépasser 2Mo.',
            'characteristics.*.label.required_with' => 'Chaque caractéristique doit avoir un libellé.',
            'characteristics.*.value.required_with' => 'Chaque caractéristique doit avoir une valeur.',
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            return redirect()->back()
                ->with('error', $firstErrorMessage);
        }

        try {

            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'category_id' => $request->category_id,
            ];

            if ($request->hasFile('image')) {
                $img = $request->file('image');
                $folderName = $request->name;
                $uploadFolder = 'assets/images/machines/';
                folderOpen($uploadFolder);
                $imgurl = uploadImage($img, $folderName, $uploadFolder);

                $data['image'] = $imgurl;
            }

            $additionnalImages = [];

            if ($request->hasFile('additionnal_images')) {
                foreach ($request->file('additionnal_images') as $file) {
                    $img = $request->file('additionnal_images');
                    $folderName = $request->name;
                    $uploadFolder = 'assets/images/machines/';
                    folderOpen($uploadFolder);
                    $imgurl = uploadImage($img, $folderName, $uploadFolder);

                    $additionnalImages[] = $imgurl;
                }
            }
            $data['additionnal_images'] = !empty($additionnalImages) ? json_encode($additionnalImages) : null;

            // Caractéristiques
            $characteristics = $request->input('characteristics', []);
            $data['characteristics'] = !empty($characteristics) ? json_encode($characteristics, JSON_UNESCAPED_UNICODE) : null;

            // Sauvegarde
            Machine::create($data);

            return redirect()->back()->with('success', 'Machine ajouté avec succès !');
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'additionnal_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'characteristics' => 'nullable|array',
            'characteristics.*.label' => 'required_with:characteristics.*.value|string|max:255',
            'characteristics.*.value' => 'required_with:characteristics.*.label|string|max:255',
        ], [
            'name.required' => 'Le nom de la machine est obligatoire.',
            'category_id.required' => 'La catégorie est obligatoire.',
            'category_id.exists' => 'La catégorie sélectionnée est invalide.',
            'price.required' => 'Le prix est obligatoire.',
            'price.integer' => 'Le prix doit être un nombre entier.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L’image doit être au format jpg, jpeg, png ou webp.',
            'image.max' => 'L’image ne doit pas dépasser 2Mo.',
            'additionnal_images.*.image' => 'Chaque fichier additionnel doit être une image.',
            'additionnal_images.*.mimes' => 'Chaque image additionnelle doit être au format jpg, jpeg, png ou webp.',
            'additionnal_images.*.max' => 'Chaque image additionnelle ne doit pas dépasser 2Mo.',
        ]);

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            return redirect()->back()
                ->with('error', $firstErrorMessage);
        }

        try {
            $machine = Machine::findOrFail($id);
            $data = $request->only(['name', 'price', 'description', 'category_id']);

            // Image principale
            if ($request->hasFile('image')) {
                // supprimer l’ancienne si elle existe
                if ($machine->image) {
                    deleteFile($machine->image);

                    $img = $request->file('image');
                    $folderName = $request->name;
                    $uploadFolder = 'assets/images/machines/';
                    folderOpen($uploadFolder);
                    $imgurl = uploadImage($img, $folderName, $uploadFolder);
                }

                $data['image'] = $imgurl;
            } else {
                $data['image'] = $machine->image; // garder l’ancienne si rien n’est envoyé
            }

            $additionnalImages = json_decode($machine->additionnal_images, true) ?? [];

            // Supprimer celles cochées côté front
            if ($request->filled('delete_additionnel_images')) {
                foreach ($request->input('delete_additionnel_images') as $imgToDelete) {
                    if (in_array($imgToDelete, $additionnalImages)) {
                        deleteFile($imgToDelete);
                        $additionnalImages = array_diff($additionnalImages, [$imgToDelete]);
                    }
                }
            }

            // Ajouter de nouvelles images si uploadées
            if ($request->hasFile('additionnal_images')) {
                foreach ($request->file('additionnal_images') as $file) {
                    $img = $file;
                    $folderName = $request->name;
                    $uploadFolder = 'assets/images/machines/';
                    folderOpen($uploadFolder);
                    $imgurl = uploadImage($img, $folderName, $uploadFolder);

                    $additionnalImages[] = $imgurl;
                }
            }

            $data['additionnal_images'] = json_encode(array_values($additionnalImages)); // réindexation

            // Caractéristiques
            $characteristics = $request->input('characteristics', json_decode($machine->characteristics, true) ?? []);
            $data['characteristics'] = json_encode($characteristics);

            // Modification
            $machine->update($data);

            return redirect()->back()->with('success', 'Machine mise à jour avec succès !');
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
            $machine = Machine::findOrFail($id);

            // Supprimer l'image principale
            if ($machine->image) {
                deleteFile($machine->image);
            }

            // Supprimer les images additionnelles
            if (!empty($machine->additionnal_images)) {
                foreach (json_decode($machine->additionnal_images) as $img) {
                    deleteFile($img);
                }
            }

            // Supprimer l'enregistrement
            $machine->delete();

            return redirect()->back()->with('success', 'Machine supprimée avec succès !');
        } catch (\Throwable $e) {
            Log::error('Erreur lors de la suppression de la machine : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
}
