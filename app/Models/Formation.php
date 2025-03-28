<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formation extends Model
{
    use HasFactory;
    protected $table = 'formations';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'Titre', 'Description', 'DateDebut', 'DateFin', 'nbrPlace', 'type'
    ];

    public function formateurInterne()
    {
        return $this->belongsTo(FormateurInterne::class, 'formateur_interne_id');
    }
}
