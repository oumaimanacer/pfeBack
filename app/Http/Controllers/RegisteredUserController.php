<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\FirebaseAuthService;



class RegisteredUserController extends Controller
{
    protected $firebaseAuth;

    public function __construct(FirebaseAuthService $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }

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
    public function store(Request $request,FirebaseAuthService $firebaseAuthService)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Enregistrer l'utilisateur dans Firebase
        $firebaseUser = $firebaseAuthService->createUser($request->all());
    
        // Sauvegarde dans la base de données locale
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'firebase_uid' => $firebaseUser->uid, // Associe l'UID Firebase
            'password' => Hash::make($request->password),
            'role' => 'employe',
        ]);
    
        Auth::login($user);
    
        return redirect()->route('dashboard')->with('success', 'Compte créé avec succès !');
    }
}
