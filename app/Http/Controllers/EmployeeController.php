<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use App\Services\FirestoreService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;


class EmployeeController extends Controller
{
    protected FirestoreService $firestoreService;

    public function __construct(FirestoreService $firestoreService)
    {
        // Injection du service Firestore
        $this->firestoreService = $firestoreService;
    }
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users')); 
    }

    public function create()
    {
        $entreprises = Entreprise::all(); // ✅ Important : envoyer les entreprises à la vue
        return view('users.create', compact('entreprises')); 
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
            'entreprise_id' => 'required|exists:entreprises,id',
            'account_status' => 'required|in:active,inactive,suspended',
        ]);
    
        // ✅ Création de l'utilisateur et affectation à $employee
        $employee = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'poste' => $request->poste,
            'dateEmbauche' => $request->dateEmbauche,
            'entreprise_id' => $request->entreprise_id,
            'account_status' => $request->account_status,
        ]);
    
        // ✅ Envoi à Firestore
        $this->firestoreService->storeEmployee($employee->toArray());
    
        return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès !');
    }
    

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $entreprises = Entreprise::all(); // ✅ Nécessaire pour le <select>
        return view('users.edit', compact('user', 'entreprises'));
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
        'entreprise_id' => 'required|exists:entreprises,id',
        'account_status' => 'required|in:active,inactive,suspended',
    ]);

    $user = User::findOrFail($id);

    $user->update([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'role' => $request->role,
        'poste' => $request->poste,
        'dateEmbauche' => $request->dateEmbauche,
        'entreprise_id' => $request->entreprise_id,
        'account_status' => $request->account_status,
    ]);

    // 🔁 Utilise $user ici, pas $employee
    $dataToStore = $user->only([
        'id', 'nom', 'prenom', 'email', 'role', 'poste', 'dateEmbauche', 'entreprise_id', 'account_status'
    ]);

    $this->firestoreService->storeEmployee($dataToStore);

    return redirect()->route('users.index')->with('success', 'Utilisateur modifié avec succès !');
}


public function destroy($id)
{
    $user = User::findOrFail($id);

    // Supprimer dans Firestore d'abord (si échec ici, ne pas supprimer localement)
    $this->firestoreService->deleteEmployee($id);

    // Ensuite, supprimer localement
    $user->delete();

    return redirect()->route('users.index')->with('success', 'Utilisateur supprimé localement et de Firestore avec succès !');
}

}
