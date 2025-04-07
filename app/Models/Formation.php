<?php

namespace App\Models;

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
        'nbr_place',
        'type',
        'formateur'
    ];
}
