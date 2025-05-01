<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Affiche le formulaire d'inscription.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Gère l'inscription d'un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        // Validation des champs requis
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Création de l'utilisateur
            $user = User::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Connexion automatique
            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Compte créé avec succès !');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du compte : ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors de la création du compte.');
        }
    }
}
