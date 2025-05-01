<?php

namespace App\Models;

use App\Models\Feedback;
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
        'formateur',
    ];

public function users()
{
    return $this->belongsToMany(User::class)
                ->withPivot('date_participation')
                ->withTimestamps();
}
public function feedbacks()
{
    return $this->hasMany(Feedback::class);
}
}
