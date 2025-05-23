<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;
use App\Models\Cours;
use Illuminate\Support\Facades\Storage;

class CoursController extends Controller
{
    // 🔸 Affiche tous les cours (ex: page publique)
    public function showAll()
    {
    $cours = Cours::orderBy('created_at', 'desc')->get();
        return view('cours', compact('cours')); // Crée la vue `resources/views/cours.blade.php`
    }

    // 🔸 Liste paginée des cours pour l'admin
    public function index()
    {
    $cours = Cours::orderBy('created_at', 'desc')->get();
        return view('cours.index', compact('cours'));
    }

    // 🔸 Formulaire de création
    public function create()
    {
        $classes = Classe::all(); // ou ->pluck('nom', 'id') si besoin d'ID
    return view('cours.create', compact('classes'));
    }

    // 🔸 Enregistrement d’un nouveau cours
    public function store(Request $request)
    {
        $request->validate([
    'titre' => 'required|string|max:255',
    'filiere' => 'required|exists:classes,id',
    'annee' => 'required|in:1ere,2eme',
    'pdf' => 'required|mimes:pdf|max:10000',
]);

        $path = $request->file('pdf')->store('cours_pdfs', 'public');

        Cours::create([
    'titre' => $request->titre,
    'filiere' => $request->filiere, // car "filiere" = id de la classe
    'annee' => $request->annee,
    'pdf_path' => $path,
]);

        return redirect()->route('cours.index')->with('success', 'Cours ajouté avec succès.');
    }

    // 🔸 Formulaire d’édition
    public function edit($id)
    {
        $cours = Cours::findOrFail($id);
        return view('cours.edit', compact('cours'));
    }

    // 🔸 Mise à jour du cours
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'filiere' => 'required|in:Informatique,Économie,Mécanique,Autre',
            'annee' => 'required|in:1ere,2eme',
            'pdf' => 'nullable|mimes:pdf|max:10000',
        ]);

        $cours = Cours::findOrFail($id);
        $cours->titre = $request->titre;
        $cours->filiere = $request->filiere;
        $cours->annee = $request->annee;

        if ($request->hasFile('pdf')) {
            if ($cours->pdf_path && Storage::disk('public')->exists($cours->pdf_path)) {
                Storage::disk('public')->delete($cours->pdf_path);
            }

            $path = $request->file('pdf')->store('cours_pdfs', 'public');
            $cours->pdf_path = $path;
        }

        $cours->save();

        return redirect()->route('cours.index')->with('success', 'Cours modifié avec succès.');
    }

    // 🔸 Suppression d’un cours
    public function destroy($id)
    {
        $cours = Cours::findOrFail($id);

        if ($cours->pdf_path && Storage::disk('public')->exists($cours->pdf_path)) {
            Storage::disk('public')->delete($cours->pdf_path);
        }

        $cours->delete();

        return redirect()->route('cours.index')->with('success', 'Cours supprimé avec succès.');
    }
}
