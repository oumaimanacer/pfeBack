<?php

namespace App\Models;

use App\Models\Formation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public function formations()
    {
        return $this->hasMany(Formation::class, 'type', 'name');
    }
}
