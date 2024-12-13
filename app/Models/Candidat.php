<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'photo',
        'slogan'
    ];
     public function votes()
    {
        return $this->hasMany(Vote::class, 'candidat_id'); // Assurez-vous que 'Vote' est le bon modèle
    }
}
