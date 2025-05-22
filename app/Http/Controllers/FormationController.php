<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Feedback;
use App\Models\Categorie;
use App\Models\Formation;
use Illuminate\Http\Request;
use App\Models\FormationUser;
use App\Services\FirestoreService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


// ... (namespace + use identiques)

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

   // public function create()
    //{
       // $employes = User::where('role', 'employé')->get();
       // return view('formations.create', compact('employes'));
    //}
    public function create()
{
    $employes = User::where('role', 'employé')->get();
    $categories = Categorie::all(); // récupère toutes les catégories
    return view('formations.create', compact('employes', 'categories'));
}

    public function store(Request $request)
{
    try {
         $validator = \Validator::make($request->all(), [
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'heure' => 'required|string|max:255',
        'nbr_place' => 'required|integer|min:1',
        'type' => 'required|string',
        'formateur_type' => 'required|string|in:interne,externe',
        'formateur_interne' => 'nullable|string|required_if:formateur_type,interne',
        'formateur_externe' => 'nullable|string|required_if:formateur_type,externe',
    ]);

    if ($validator->fails()) {
        dd($validator->errors()); // 🛑 Cela va te montrer exactement l'erreur
    }

        $formation = Formation::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'heure' => $request->heure,
            'nbr_place' => $request->nbr_place,
            'type' => $request->type,
            'formateur' => $request->formateur_type === 'interne'
                ? $request->formateur_interne
                : $request->formateur_externe,
        ]);

    
         $this->firestore->storeFormation($formation);

        return redirect()->route('formations.index')->with('success', 'Formation ajoutée avec succès.');
    } catch (\Exception $e) {
        dd("Erreur attrapée :", $e->getMessage(), $e->getTraceAsString());
    }
}
public function edit($id)
    {
        $formation = Formation::findOrFail($id);
        return view('formations.edit', compact('formation'));
    }

    public function update(Request $request, $id)
    {
        //$request->validate([
         $validator = \Validator::make($request->all(), [
            'Titre' => 'required|string|max:255',
            'Description' => 'required|string',
            'Date_Debut' => 'required|date',
            'Date_Fin' => 'required|date|after_or_equal:Date_Debut',
            'heure' => 'required|string|max:10', 
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
            'heure' => $request->heure, 
            'nbr_place' => $request->nbr_place,
            'type' => $request->type,
            'formateur' => $request->formateur,
        ]);

        $this->firestore->storeFormation($formation);

        return redirect()->route('formations.index')->with('success', 'Formation mise à jour avec succès.');
    }



    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();
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
    //Synchroniser les participations aux formations enregistrées dans Firebase vers la table pivot formation_user dans la base de données Laravel.
   public function syncFromFirebase(Request $request)
{
    try {
        // Cherche l'utilisateur par son firebase_uid
        $user = User::where('firebase_uid', $request->userId)->first();

        if (!$user) {
            Log::warning('Utilisateur non trouvé pour firebase_uid: ' . $request->userId);
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }

        // Vérifie si la ligne existe déjà pour éviter les doublons
        $exists = DB::table('formation_user')->where([
            ['user_id', '=', $user->id],
            ['formation_id', '=', $request->formationId],
        ])->exists();

        if ($exists) {
            return response()->json(['message' => 'Déjà synchronisé'], 200);
        }

        // Insère dans la table pivot
        DB::table('formation_user')->insert([
            'user_id' => $user->id,
            'formation_id' => $request->formationId,
            'created_at' => now(),
        ]);

        return response()->json(['message' => 'Synchronisation réussie']);
    } catch (\Exception $e) {
        Log::error('Erreur de sync Firebase : '.$e->getMessage());
        return response()->json(['error' => 'Erreur serveur'], 500);
    }
}
//Synchroniser les avis/notes/commentaires laissés dans Firebase vers la table feedbacks de Laravel.
public function syncFeedback(Request $request)
{
    try {
        $request->validate([
            'userId' => 'required|string',
            'formationId' => 'required|integer',
            'contenu' => 'required|string', // s'assurer que c'est bien là
        ]);

        $user = User::where('firebase_uid', $request->userId)->first();
        if (!$user) {
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }

        Feedback::create([
            'user_id' => $user->id,
            'formation_id' => $request->formationId,
            'contenu' => $request->contenu, // ✅ Bien inclure ce champ ici
        ]);

        return response()->json(['message' => 'Feedback enregistré.']);
    } catch (\Exception $e) {
        \Log::error('Erreur feedback sync: ' . $e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}
