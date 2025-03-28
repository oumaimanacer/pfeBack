<?php

namespace App\Models;
use App\Models\Employe;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail; 
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    protected $fillable = ['nom', 'prenom', 'email', 'password', 'role'];

    public function employes()
    {
        return $this->hasMany(Employe::class);
    }
}
