<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('apps.pages.backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'L\'adresse e-mail est requise.',
                'email.email' => 'L\'adresse e-mail n\'est pas valide.',
                'password.required' => 'Le mot de passe est requis.'
            ]
        );

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            return redirect()->back()->with('error', $firstErrorMessage);
        }

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect.');
        }

        try {

            if (Auth::attempt($credentials)) {
                return redirect()->route('panel.index')->with('success', 'Connexion réussie');
            }

            return redirect()->back()->with('error', 'Identifiants invalides.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la connexion : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la connexion.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'nullable|min:2',
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'name.min' => 'Le nom doit être un chaine de caractère',
                'email.required' => 'L\'adresse e-mail est requise.',
                'email.email' => 'L\'adresse e-mail n\'est pas valide.',
                'password.required' => 'Le mot de passe est requis.'
            ]
        );

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            return redirect()->back()->with('error', $firstErrorMessage);
        }

        try {
            $data = $request->only(['name', 'email']);

            $data['password'] = Hash::make($request->input('password'));

            User::create($data);

            return redirect()->back()->with('success', 'Utilisateur créé avec succès.');
        } catch (\Exception $e) {
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
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'nullable|min:2',
                'email' => 'required|email',
                'status' => 'required',
            ],
            [
                'name.min' => 'Le nom doit être un chaine de caractère',
                'email.required' => 'L\'adresse e-mail est requise.',
                'email.email' => 'L\'adresse e-mail n\'est pas valide.',
                'status.required' => 'Le status est requis.'
            ]
        );

        if ($validator->fails()) {
            $firstErrorMessage = $validator->errors()->first();
            return redirect()->back()->with('error', $firstErrorMessage);
        }

        try {
            $user = User::find($id);

            $data = $request->only(['name', 'email', 'status']);

            $user->update($data);

            return redirect()->back()->with('success', 'Utilisateur modifié avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'ajout : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'ajout. Veuillez reéssayer.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();

            return redirect()->back()->with('success', 'Utilisateur supprimé avec succès.');
        } catch (\Throwable $e) {
            Log::error('Erreur lors de la suppression : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Déconnexion réussie');
    }
}
