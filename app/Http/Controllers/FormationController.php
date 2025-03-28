<?php

namespace App\Http\Controllers;

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
    return view('formations.create');
}

public function store(Request $request)
{
    $request->validate([
        'Titre' => 'required|string|max:255',
        'Description' => 'required|string',
        'DateDebut' => 'required|date',
        'DateFin' => 'required|date|after_or_equal:DateDebut',
        'nbrPlace' => 'required|integer|min:1',
        'type' => 'required|string',
    ]);

    $formation = new Formation();
    $formation->Titre = $request->Titre;
    $formation->Description = $request->Description;
    $formation->DateDebut = $request->DateDebut;
    $formation->DateFin = $request->DateFin;
    $formation->nbrPlace = $request->nbrPlace;
    $formation->type = $request->type;

    $formation->save();

    return redirect()->route('formations.index')->with('success', 'Formation ajoutée avec succès.');
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
    ]);

    $formation = Formation::findOrFail($id);
    $formation->Titre = $request->Titre;
    $formation->Description = $request->Description;
    $formation->DateDebut = $request->DateDebut;
    $formation->DateFin = $request->DateFin;
    $formation->nbrPlace = $request->nbrPlace;
    $formation->type = $request->type;


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
