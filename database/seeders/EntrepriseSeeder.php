<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use Illuminate\Database\Seeder; // ← ← ← ICI !

class EntrepriseSeeder extends Seeder
{
    public function run()
    {
        Entreprise::create([
            'nom_entreprise' => 'Elyos Digital Tunisie',
            'secteur_activite' => 'Informatique',
            'adresse' => 'Tunis Centre',
            'numero_de_telephone' => '073449596',
            'nombre_employes' => 150,
            'email' => 'naceroumaima86@gmail.com',
            'password' => bcrypt('oumaima2020'),
        ]);
    }
}
