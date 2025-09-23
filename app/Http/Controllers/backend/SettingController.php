<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AppBasics;
use App\Models\Banner;
use App\Models\BannerCarrousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::first();
        $appBasics = AppBasics::first();
        $banner = Banner::first();
        $carrousels = BannerCarrousel::all();
        return view('apps.pages.backend.settings.index', compact('about', 'appBasics', 'banner', 'carrousels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function aboutUpdate(Request $request, string $id)
    {
        $about = About::findOrFail($id);

        $data = $request->validate([
            'about_text' => 'required|string',
            'mission_text' => 'required|string',
            'about_image' => 'nullable|image|mimes:jpg,png,jpeg,webp',
            'mission_image' => 'nullable|image|mimes:jpg,png,jpeg,webp',
        ]);

        if ($request->hasFile('about_image')) {
            deleteFile($about->about_image);

            $img = $request->file('about_image');
            $folderName = 'a-propos';
            $uploadFolder = 'assets/images/abouts/';
            folderOpen($uploadFolder);
            $imgurl = uploadImage($img, $folderName, $uploadFolder);

            $data['about_image'] = $imgurl;
        }

        if ($request->hasFile('mission_image')) {
            deleteFile($about->mission_image);

            $img = $request->file('mission_image');
            $folderName = 'a-propos';
            $uploadFolder = 'assets/images/missions/';
            folderOpen($uploadFolder);
            $imgurl = uploadImage($img, $folderName, $uploadFolder);

            $data['mission_image'] = $imgurl;
        }

        $about->update($data);

        return back()->with('success', 'À propos mis à jour avec succès.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function appBasicsUpdate(Request $request, string $id)
    {
        $appBasics = AppBasics::findOrFail($id);

        $data = $request->validate([
            'contact' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'privacy_policy' => 'nullable|string',
            'plateform_current_state' => 'in:RUN,MAINTENANCE',
        ]);

        $appBasics->update($data);

        return back()->with('success', 'Paramètres généraux mis à jour avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function bannerUpdate(Request $request, string $id)
    {
        $banner = Banner::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('background_image')) {
            deleteFile($banner->background_image);

            $img = $request->file('background_image');
            $folderName = 'a-propos';
            $uploadFolder = 'assets/images/backgrounds/';
            folderOpen($uploadFolder);
            $imgurl = uploadImage($img, $folderName, $uploadFolder);

            $data['background_image'] = $imgurl;
        }

        $banner->update($data);

        return back()->with('success', 'Bannière mise à jour avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function bannerCarrouselStore(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $folderName = 'carrousel';
            $uploadFolder = 'assets/images/carrousels/';
            folderOpen($uploadFolder);
            $imgurl = uploadImage($img, $folderName, $uploadFolder);

            $data['image'] = $imgurl;
        }


        BannerCarrousel::create($data);

        return back()->with('success', 'Image ajoutée au carrousel.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function profile()
    {
        return view('apps.pages.backend.profile.index');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|max:255|unique:users,email,{$user->id}",
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:8|confirmed',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',

            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'adresse email doit être valide.',
            'email.unique' => 'Cet email est déjà utilisé.',

            'current_password.required_with' => 'Vous devez entrer votre mot de passe actuel pour en définir un nouveau.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
            }

            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function bannerCarrouselDestroy(string $id)
    {
        $carrousel = BannerCarrousel::findOrFail($id);

        deleteFile($carrousel->image);
        $carrousel->delete();

        return back()->with('success', 'Image supprimée du carrousel.');
    }
}
