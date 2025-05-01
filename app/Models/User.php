<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;
    use HasApiTokens;

    // Champs modifiables en masse
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'role',
        'poste',
        'dateEmbauche',
        'entreprise_id',
        'account_status',
    ];

    // Champs à cacher dans les JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Type de données à caster
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dateEmbauche' => 'date',
    ];

    // 🔁 Relation avec l'entreprise
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    // 🔁 Relation avec les formations (many-to-many)
    public function formations()
    {
        return $this->belongsToMany(Formation::class)
                    ->withPivot('date_participation')
                    ->withTimestamps();
    }

    // 🔁 Relation avec les feedbacks
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    // ✅ Helper pour vérifier si le compte est actif
    public function isActive()
    {
        return $this->account_status === 'actif';
    }
   


    
}
