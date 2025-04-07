<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users')); 
    }
  
    public function create()
    {
        return view('users.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:SuperAdmin,Admin,Employe,Responsable RH,Formateur_interne,Formateur_externe',
            'poste' => 'nullable|string|max:255',
            'dateEmbauche' => 'nullable|date',
            'entreprise' => 'nullable|string|max:255',
        ]);

        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hachage du mot de passe
            'role' => $request->role,
            'poste' => $request->poste,
            'dateEmbauche' => $request->dateEmbauche,
            'entreprise' => $request->entreprise,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès !');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user')); // Correction de la variable
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:SuperAdmin,Admin,Employe,Responsable RH,Formateur_interne,Formateur_externe',
            'poste' => 'nullable|string|max:255',
            'dateEmbauche' => 'nullable|date',
            'entreprise' => 'nullable|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'role' => $request->role,
            'poste' => $request->poste,
            'dateEmbauche' => $request->dateEmbauche,
            'entreprise' => $request->entreprise,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur modifié avec succès !');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès !');
    }
}
