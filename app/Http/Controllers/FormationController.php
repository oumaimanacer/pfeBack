<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Feedback;
use App\Models\Formation;
use Illuminate\Http\Request;
use App\Services\FirestoreService;
use Illuminate\Routing\Controller;

class FormationController extends Controller
{
    protected $firestore;

    public function __construct(FirestoreService $firestore)
    {
        $this->firestore = $firestore;
    }

    public function index()
    {
        $formations = Formation::all(); 
        return view('formations.index', compact('formations'));
    }

    public function create()
    {
        $employes = User::where('role', 'employé')->get();
        return view('formations.create', compact('employes'));
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

        $formation = Formation::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'nbr_place' => $request->nbr_place,
            'type' => $request->type,
            'formateur' => $request->formateur_type === 'interne'
                ? $request->formateur_interne
                : $request->formateur_externe,
        ]);

        $this->firestore->storeFormation($formation);

        return redirect()->route('formations.index')->with('success', 'Formation ajoutée localement et dans Firestore !');
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
            'Date_Debut' => 'required|date',
            'Date_Fin' => 'required|date|after_or_equal:date_debut',
            'nbr_place' => 'required|integer|min:1',
            'type' => 'required|string',
            'formateur' => 'required|string',
        ]);

        $formation = Formation::findOrFail($id);

        $formation->update([
            'Titre' => $request->Titre,
            'Description' => $request->Description,
            'Date_Debut' => $request->Date_Debut,
            'Date_Fin' => $request->Date_Fin,
            'nbr_place' => $request->nbr_place,
            'type' => $request->type,
            'formateur' => $request->formateur,
        ]);

        $this->firestore->storeFormation($formation); // facultatif: mettre à jour Firestore si nécessaire

        return redirect()->route('formations.index')->with('success', 'Formation mise à jour avec succès.');
    }

    public function destroy($id)
{
    $formation = Formation::findOrFail($id);

    // Supprimer localement
    $formation->delete();

    // Supprimer dans Firestore
    $this->firestore->deleteFormation($id);

    return redirect()->route('formations.index')->with('success', 'Formation supprimée localement et de Firestore.');
}

    public function show($id)
    {
        $formation = Formation::with(['users', 'feedbacks'])->findOrFail($id);
        return view('formations.show', compact('formation'));
    }

    public function participants(Formation $formation)
    {
        $formation->load('users');
        return view('formations.participants', compact('formation'));
    }

    public function feedbacks(Formation $formation)
    {
        $formation->load('feedbacks.user');
        return view('formations.feedbacks', compact('formation'));
    }

    public function showParticipant($id)
    {
        $user = User::findOrFail($id);
        return view('participants.show', compact('user'));
    }
}
