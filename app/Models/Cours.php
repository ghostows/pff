<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'filiere',
        'annee',
        'pdf_path',
    ];


    public function classe()
{
    return $this->belongsTo(Classe::class, 'filiere'); // filiere est en fait classe_id
}

}
