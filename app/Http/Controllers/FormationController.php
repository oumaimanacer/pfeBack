<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FormationController extends Controller
{
    public function index()
    {

        $formations = Formation::all(); 
        return view('formations.index', compact('formations'));
        //dd($formations);
    }
    public function create()
{
    $users = User::all(); // Récupérer tous les utilisateurs

    return view('formations.create',compact('users'));
}

public function store(Request $request)
{
    $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'nbr_place' => 'required|integer|min:1',
        'type' => 'required|string',
        'formateur_type' => 'required|string|in:interne,externe',
        'formateur_interne' => 'nullable|string|required_if:formateur_type,interne',
        'formateur_externe' => 'nullable|string|required_if:formateur_type,externe',
    ]);

    Formation::create([
        'titre' => $request->titre,
        'description' => $request->description,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'nbr_place' => $request->nbr_place,
        'type' => $request->type,
        'formateur' => $request->formateur_type === 'interne' ? $request->formateur_interne : $request->formateur_externe,
    ]);

    return redirect()->route('formations.index')->with('success', 'Formation ajoutée avec succès !');
}


    public function edit($id)
{
    $formation = Formation::findOrFail($id);
    return view('formations.edit', compact('formation'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'Titre' => 'required|string|max:255',
        'Description' => 'required|string',
        'DateDebut' => 'required|date',
        'DateFin' => 'required|date|after_or_equal:DateDebut',
        'nbrPlace' => 'required|integer|min:1',
        'type' => 'required|string',
        'formateur' => 'required|string',
    ]);

    $formation = Formation::findOrFail($id);
    $formation->Titre = $request->Titre;
    $formation->Description = $request->Description;
    $formation->DateDebut = $request->DateDebut;
    $formation->DateFin = $request->DateFin;
    $formation->nbrPlace = $request->nbrPlace;
    $formation->type = $request->type;
    $formation->formateur = $request->formateur;


    $formation->save();

    return redirect()->route('formations.index')->with('success', 'Formation mise à jour avec succès.');
}
public function destroy($id)
{
    $formation = Formation::findOrFail($id);


    $formation->delete();

    return redirect()->route('formations.index')->with('success', 'Formation supprimée avec succès.');
}


}
