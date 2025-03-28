<?php
namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $entreprises = Entreprise::all();
        return view('admin.list', compact('entreprises'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        //Entreprise::create($request->all());
        //return redirect()->route('admin.list');
        $request->validate([
            'nom_entreprise' => 'required|string|max:255',
            'secteur_activite' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'numero_de_telephone' => 'required|string|max:20', 
            'nombre_employes' => 'required|integer|min:1',
            'email' => 'required|email|unique:entreprises,email',
            'password' => 'required|string|min:6',
        ]);
    
        Entreprise::create([
            'nom_entreprise' => $request->nom_entreprise,
            'secteur_activite' => $request->secteur_activite,
            'adresse' => $request->adresse,
            'numero_de_telephone' => $request->numero_de_telephone, 
            'nombre_employes' => $request->nombre_employes,
            'email' => $request->email,
            'password' => bcrypt($request->password), 
        ]);
    
        return redirect()->route('entreprise.list')->with('success', 'Entreprise ajoutée avec succès.');
    }
    public function edit($id)
    {
        $entreprises = Entreprise::findOrFail($id);
        return view('admin.edit', compact('entreprises'));
    }

    public function update(Request $request, $id)
    {
        $entreprises = Entreprise::findOrFail($id);
        $entreprises->update($request->all());
        return redirect()->route('entreprise.list');
    }

    public function destroy($id)
    {
        Entreprise::destroy($id);
        return redirect()->route('entreprise.list');
    }
}
