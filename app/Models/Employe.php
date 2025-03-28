<?php

namespace App\Models;
use App\Models;
use App\Models\User;
use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employe extends Model
{
    use HasFactory;
    protected $fillable = ['poste', 'date_embauche', 'user_id', 'entreprise_id'];

    public function utilisateur() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function entreprise() {
        return $this->belongsTo(Entreprise::class);
    }
}
