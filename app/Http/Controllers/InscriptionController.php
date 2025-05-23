<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{

    public function index()
{
    $candidats = Candidat::latest()->get(); // Récupère les candidats les plus récents en premier
    return view('candidat', compact('candidats'));
}
    public function create()
    {
        return view('inscription.create'); // Ce fichier doit exister
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'age' => 'required|integer|max:30',
            'email' => 'required|email|unique:candidats',
            'cin' => 'required|string|unique:candidats',
            'adresse' => 'required|string',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'niveau_scolaire' => 'required|in:bac,niveau_bac,troisieme,primaire',
            'document' => 'required|mimes:pdf,jpg,jpeg,png|max:4096',
        ]);

        // Logique d’orientation selon le niveau
        $typeFormation = match($validated['niveau_scolaire']) {
            'bac' => 'Technicien Spécialisé',
            'niveau_bac' => 'Technicien',
            'troisieme' => 'Qualification',
            default => 'Non admissible',
        };

        if ($typeFormation === 'Non admissible') {
            return back()->withErrors(['niveau_scolaire' => 'Ce niveau ne permet pas l’accès à une formation.']);
        }

        // Enregistrement
        $photoPath = $request->file('photo')->store('photos', 'public');
        $documentPath = $request->file('document')->store('documents', 'public');

        Candidat::create([
            ...$validated,
            'photo' => $photoPath,
            'document' => $documentPath,
            'formation_type' => $typeFormation,
        ]);

return redirect('/home/inscription/success'); // Testez en dur
    }
}

