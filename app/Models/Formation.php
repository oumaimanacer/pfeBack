<?php

namespace App\Models;

use App\Models\Feedback;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formation extends Model
{
    use HasFactory;

    protected $table = 'formations';

    protected $fillable = [
        'titre',
        'description',
        'date_debut',
        'date_fin',
        'heure',           // ✅ Ajouté si tu l'as bien ajouté à la table
        'nbr_place',
        'type',
        'formateur',
    ];

    /**
     * Utilisateurs participants à la formation
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('date_participation')
                    ->withTimestamps();
    }

    /**
     * Feedbacks associés à la formation
     */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    /**
     * ✅ Relation personnalisée vers la catégorie
     * type (dans formations) fait référence à name (dans categories)
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'type', 'name');
    }
}
