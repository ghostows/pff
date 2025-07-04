<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'age',
        'email',
        'cin',
        'adresse',
        'photo',
        'document',
        'niveau_scolaire',
        'formation_type',
    ];
}

