<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormateurInterne extends Model
{
    use HasFactory;
    protected $table = 'formateurs_internes';
    protected $fillable = [];

    public function formations()
    {
        return $this->hasMany(Formation::class, 'formateur_interne_id');
    }
}
