<?php

// app/Http/Controllers/EtudiantDashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;

class EtudiantDashboardController extends Controller
{
    public function index(Request $request)
    {
        $etudiantId = session('etudiant_id');

$etudiant = Etudiant::with(['classe.cours', 'notes.matiere', 'absences' , 'parentEtudiant'])->findOrFail(session('etudiant_id'));

    return view('etudiant.dashboard', compact('etudiant'));
    }
}
