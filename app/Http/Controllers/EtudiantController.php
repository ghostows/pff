<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Classe;
use App\Models\ParentEtudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    public function index(Request $request)
    {
        $query = Etudiant::with('classe');

        if ($request->filled('identifiant')) {
            $query->where('identifiant', 'like', '%' . $request->identifiant . '%');
        }

        if ($request->filled('classe_id')) {
            $query->where('classe_id', $request->classe_id);
        }

$etudiants = $query->paginate(30); // Tu peux ajuster le nombre par page ici
        $classes = Classe::all();

        return view('etudiants.index', compact('etudiants', 'classes'));
    }

    public function create()
    {
        $classes = Classe::all();
        return view('etudiants.create', compact('classes'));
    }


public function store(Request $request)
{
    $validated = $request->validate([
        'identifiant' => 'required|unique:etudiants',
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'date_naissance' => 'required|date',
        'email' => 'required|email|unique:etudiants',
        'telephone' => 'required|string|max:20',
        'adresse' => 'required|string|max:255',
        'classe_id' => 'required|exists:classes,id',

        'parent_nom' => 'required|string|max:255',
        'parent_email' => 'required|email|unique:parents,email',
        'parent_telephone' => 'required|string|max:20',
    ]);

    // 🔐 Génération d’un mot de passe simple (ex: 2006-07-10 => 10072006)
    $date = $validated['date_naissance'];
    $password_plain = date('dmY', strtotime($date));

    // ✅ Hash du mot de passe pour stockage sécurisé
    $password_hashed = Hash::make($password_plain);

    $etudiant = Etudiant::create([
        'identifiant' => $validated['identifiant'],
        'nom' => $validated['nom'],
        'prenom' => $validated['prenom'],
        'date_naissance' => $validated['date_naissance'],
        'email' => $validated['email'],
        'telephone' => $validated['telephone'],
        'adresse' => $validated['adresse'],
        'classe_id' => $validated['classe_id'],
        'password' => $password_hashed,
            'password_plain' => $password_plain,

    ]);

    ParentEtudiant::create([
        'etudiant_id' => $etudiant->id,
        'nom' => $validated['parent_nom'],
        'email' => $validated['parent_email'],
        'telephone' => $validated['parent_telephone'],
    ]);

    // ✅ Affiche un message ou envoie par email si tu veux
    return redirect()->route('etudiants.index')
        ->with('success', 'Étudiant créé avec succès ! Mot de passe : ' . $password_plain);
}


    public function show($id)
    {
        $etudiant = Etudiant::with(['classe', 'parentEtudiant', 'notes.matiere', 'absences.matiere'])->findOrFail($id);
        return view('etudiants.show', compact('etudiant'));
    }

    public function edit($id)
{
    $etudiant = Etudiant::with('parentEtudiant', 'classe')->findOrFail($id);
    $classes = Classe::all(); // Pour afficher la liste des classes dans le formulaire
    return view('etudiants.edit', compact('etudiant', 'classes'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'identifiant' => 'required|string|max:50|unique:etudiants,identifiant,' . $id,
        'email' => 'nullable|email',
        'telephone' => 'nullable|string|max:20',
        'adresse' => 'nullable|string|max:255',
        'date_naissance' => 'nullable|date',
        'classe_id' => 'required|exists:classes,id',
    ]);

    $etudiant = Etudiant::findOrFail($id);
    $etudiant->update($request->all());

    return redirect()->route('etudiants.show', $etudiant->id)
        ->with('success', 'Étudiant mis à jour avec succès.');
}




    public function destroy($id)
{
    $etudiant = Etudiant::findOrFail($id);

    // Supprimer aussi les données associées si nécessaire
    if ($etudiant->parentEtudiant) {
        $etudiant->parentEtudiant->delete();
    }

    $etudiant->delete();

    return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé avec succès.');
}

}
