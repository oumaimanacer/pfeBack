<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedbacks'; 


    protected $fillable = [
        'user_id',
        'formation_id',
        'contenu',
    ];

    // 🔁 Relation : un feedback appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔁 Relation : un feedback appartient à une formation
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}
