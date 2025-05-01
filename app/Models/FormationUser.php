<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FormationUser extends Pivot
{
    protected $table = 'formation_user';

    protected $fillable = [
        'user_id',
        'formation_id',
        'date_participation',
    ];

    protected $casts = [
        'date_participation' => 'date',
    ];

    // 🔁 Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔁 Relation avec la formation
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}
