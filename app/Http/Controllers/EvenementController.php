<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Evenement;

class EvenementController extends Controller
{



    // Affiche tous les événements (ex: page publique)
    public function showAll()
    {
        $evenements = Evenement::all();
        return view('evenements', compact('evenements'));
    }

    // Liste paginée des événements (ex: panneau admin)
    public function index()
    {
        $evenements = Evenement::paginate(10);
        return view('evenements.index', compact('evenements'));
    }

    // Affiche le formulaire de création d'un événement
    public function create()
    {
        return view('evenements.create');
    }

    // Enregistre un nouvel événement
public function store(Request $request)
{
    $request->validate([
    'titre' => 'required|string|max:255',
    'description' => 'required|string',
    'infos' => 'required|string',
    'date_event' => 'required|date',
    'heure_debut' => 'required|date_format:H:i',
    'heure_fin' => [
        'required',
        'date_format:H:i',
        function ($attribute, $value, $fail) use ($request) {
            if (strtotime($value) <= strtotime($request->heure_debut)) {
                $fail('L\'heure de fin doit être après l\'heure de début.');
            }
        },
    ],
    'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('evenements', 'public');
    }

    Evenement::create([
        'titre' => $request->input('titre'),
        'description' => $request->input('description'),
        'infos' => $request->input('infos'),
        'date_event' => $request->input('date_event'), // Assurez-vous que votre modèle a ce champ
        'heure_debut' => $request->input('heure_debut'),
        'heure_fin' => $request->input('heure_fin'),
        'image_path' => $imagePath,
    ]);

    return redirect()->route('evenements.index')->with('success', 'Événement ajouté avec succès !');
}

    // Formulaire d'édition d'un événement
    public function edit($id)
    {
        $evenement = Evenement::findOrFail($id);
        return view('evenements.edit', compact('evenement'));
    }

    // Mise à jour d'un événement
    public function update(Request $request, $id)
{
    $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'infos' => 'required|string',
        'date_event' => 'required|date',  // Utilisez le nom du champ dans la BDD
        'heure_debut' => 'required|date_format:H:i',
        'heure_fin' => [
            'required',
            'date_format:H:i',
            function ($attribute, $value, $fail) use ($request) {
                if (strtotime($value) <= strtotime($request->heure_debut)) {
                    $fail('L\'heure de fin doit être après l\'heure de début.');
                }
            },
        ],
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $evenement = Evenement::findOrFail($id);

    // Gestion de l'image
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image si elle existe
        if ($evenement->image_path) {
            Storage::delete('public/'.$evenement->image_path);
        }
        $imagePath = $request->file('image')->store('evenements', 'public');
        $evenement->image_path = $imagePath;
    }

    // Mise à jour des données
    $evenement->update([
        'titre' => $request->titre,
        'description' => $request->description,
        'infos' => $request->infos,
        'date_event' => $request->date_event,  // Champ correct pour la BDD
        'heure_debut' => $request->heure_debut,
        'heure_fin' => $request->heure_fin,
        'image_path' => $evenement->image_path, // Conserve l'ancienne image si pas de nouvelle
    ]);

    return redirect()->route('evenements.index')->with('success', 'Événement mis à jour avec succès !');
}

    // Supprimer un événement
    public function destroy($id)
    {
        $evenement = Evenement::findOrFail($id);

        if ($evenement->image_path) {
            unlink(storage_path('app/public/' . $evenement->image_path));
        }

        $evenement->delete();

        return redirect()->route('evenements.index')->with('success', 'Événement supprimé avec succès !');
    }
}
