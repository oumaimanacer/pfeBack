<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
        //dd($request->all());

        //return redirect()->route('dashboard')->with('success', 'Compte créé avec succès !');

            // Validation des données
            $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
        
            // Création de l'utilisateur
            $user = User::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'employe', // Ajout d'un rôle par défaut
            ]);
        
            // Connexion automatique après l'inscription
            Auth::login($user);
        
            // Redirection vers le tableau de bord avec un message de succès
            return redirect()->route('dashboard')->with('success', 'Compte créé avec succès !');
        }
        
}

