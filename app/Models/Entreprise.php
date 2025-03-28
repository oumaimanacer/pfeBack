<?php

namespace App\Models;

use App\Models;
use App\Models\Employe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entreprise extends Model
{
    use HasFactory;
    protected $fillable = ['nom_entreprise', 'secteur_activite', 'adresse', 'numero_de_telephone', 'nombre_employes','email','password'];

    public function employes() {
        return $this->hasMany(Employe::class);
    }
}
