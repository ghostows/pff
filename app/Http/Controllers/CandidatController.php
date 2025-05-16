<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
    use App\Mail\CandidatApprouve;
use App\Mail\CandidatDecline;
use Illuminate\Support\Facades\Mail;
use App\Models\Candidat;

class CandidatController extends Controller
{
    
   

public function approuver($id)
{
    $candidat = Candidat::findOrFail($id);
    // Exemple : $candidat->statut = 'approuvé'; $candidat->save();

    Mail::to($candidat->email)->send(new CandidatApprouve($candidat));

    return back()->with('success', 'Candidat approuvé et email envoyé.');
}

public function decliner($id)
{
    $candidat = Candidat::findOrFail($id);
    // Exemple : $candidat->statut = 'refusé'; $candidat->save();

    Mail::to($candidat->email)->send(new CandidatDecline($candidat));

    return back()->with('success', 'Candidat décliné et email envoyé.');
}

}
