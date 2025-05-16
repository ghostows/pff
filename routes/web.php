<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Models\Actualite;
use App\Models\Evenement;
use App\Models\Filiere;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\ClasseStatsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\EtudiantDashboardController;

/**
 * Page d'accueil
 */


/**
 * Routes d'authentification accessibles uniquement aux invités
 */
Route::middleware('guest')->group(function () {
    // Formulaire de connexion
    Route::get('/connexion', [AuthController::class, 'showLoginForm'])->name('auth.connexion');
    // Soumission du formulaire de connexion
    Route::post('/connexion', [AuthController::class, 'login']);

    // Formulaire d'inscription
    Route::get('/inscription', [RegisterController::class, 'showRegistrationForm'])->name('auth.inscription');
    // Soumission du formulaire d'inscription
    Route::post('/inscription', [RegisterController::class, 'register']);
});

/**
 * Route de déconnexion (accessible aux utilisateurs connectés)
 */
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

/**
 * Tableau de bord utilisateur (à adapter selon ton application)
 */
Route::middleware('auth')->group(function () {
    // Dashboard général (utilisateur non-admin)
    Route::get('/dashboard', function () {
        return view('dashboard'); // crée un fichier resources/views/dashboard.blade.php
    })->name('dashboard');

    // Dashboard admin
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard'); // crée resources/views/admin/dashboard.blade.php
        })->name('admin.dashboard');
    });
});
// Route de déconnexion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



















Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


    Route::get('/dashboard/messages', [ContactController::class, 'index'])->name('contact.index');
 
     Route::get('/dashboard/etudiants',[EtudiantController::class, 'index'])->name('etudiants.index');
     Route::resource('etudiants', EtudiantController::class)->only(['index', 'create', 'store', 'show']);

     Route::get('etudiants/{etudiant}/absence/create', [AbsenceController::class, 'create'])->name('absences.create');
    Route::post('absences', [AbsenceController::class, 'store'])->name('absences.store');

    Route::get('etudiants/{etudiant}/note/create', [NoteController::class, 'create'])->name('notes.create');
    Route::post('notes', [NoteController::class, 'store'])->name('notes.store');

    Route::resource('etudiants', EtudiantController::class);



    Route::get('notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
Route::put('notes/{note}', [NoteController::class, 'update'])->name('notes.update');
Route::delete('notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');

Route::get('absences/{absence}/edit', [AbsenceController::class, 'edit'])->name('absences.edit');
Route::put('absences/{absence}', [AbsenceController::class, 'update'])->name('absences.update');
Route::delete('absences/{absence}', [AbsenceController::class, 'destroy'])->name('absences.destroy');



  Route::get('/dashboard/statistiques', [DashboardController::class, 'statistiques'])->name('dashboard.statistiques');
    Route::get('/dashboard/classe/{id}/stats', [ClasseStatsController::class, 'show'])->name('classe.stats');




    // Création filière
    Route::get('/filieres', [FiliereController::class, 'index'])->name('filieres.index');
    Route::get('/filieres/create', [FiliereController::class, 'create'])->name('filieres.create');
    Route::post('/filieres', [FiliereController::class, 'store'])->name('filieres.store');
    
    Route::get('/filieres/{id}/edit', [FiliereController::class, 'edit'])->name('filieres.edit');
    Route::put('/filieres/{id}', [FiliereController::class, 'update'])->name('filieres.update');
    Route::delete('/filieres/{id}', [FiliereController::class, 'destroy'])->name('filieres.destroy');

    
    // Création événement

    Route::get('/evenements', [EvenementController::class, 'index'])->name('evenements.index');
    Route::get('/evenements/create', [EvenementController::class, 'create'])->name('evenements.create');
    Route::post('/evenements', [EvenementController::class, 'store'])->name('evenements.store');
    
    Route::get('/evenements/{id}/edit', [EvenementController::class, 'edit'])->name('evenements.edit');
    Route::put('/evenements/{id}', [EvenementController::class, 'update'])->name('evenements.update');
    Route::delete('/evenements/{id}', [EvenementController::class, 'destroy'])->name('evenements.destroy');
    


    // Création actualité

    Route::resource('actualites', ActualiteController::class);

    // Création cours
Route::get('/cours', [CoursController::class, 'index'])->name('cours.index'); // Liste des cours
Route::get('/cours/create', [CoursController::class, 'create'])->name('cours.create'); // Formulaire de création
Route::post('/cours', [CoursController::class, 'store'])->name('cours.store'); // Enregistrement d'un cours

Route::get('/cours/{id}/edit', [CoursController::class, 'edit'])->name('cours.edit'); // Formulaire d'édition
Route::put('/cours/{id}', [CoursController::class, 'update'])->name('cours.update'); // Mise à jour du cours
Route::delete('/cours/{id}', [CoursController::class, 'destroy'])->name('cours.destroy'); // Suppression du cours

    
});



////////////////////////////////////











Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/home/filiere', [FiliereController::class, 'showAll'])->name('filiere.page');
Route::get('/home/evenements', [EvenementController::class, 'showAll'])->name('evenements.page');
Route::get('/home/actualites', [ActualiteController::class, 'showAll'])->name('actualites.page');



Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');








Route::get('/evenements', [EvenementController::class, 'index'])->name('evenements.index');
Route::get('/actualites', [ActualiteController::class, 'index'])->name('actualites.index');







use App\Http\Controllers\InscriptionController;

// Formulaire d'inscription
Route::get('/home/inscription', [InscriptionController::class, 'create'])->name('inscription.create');

// Traitement du formulaire
Route::post('/home/inscription', [InscriptionController::class, 'store'])->name('inscription.store');

// Page de succès après inscription
Route::get('/home/inscription/success', function () {
    return view('inscription.success');
})->name('inscription.success');








Route::post('/candidats/{id}/approuver', [CandidatController::class, 'approuver'])->name('candidats.approuver');
Route::post('/candidats/{id}/decliner', [CandidatController::class, 'decliner'])->name('candidats.decliner');


















use App\Http\Controllers\EtudiantLoginController;

// Formulaire de connexion étudiant
Route::get('/etudiant/login', [EtudiantLoginController::class, 'showLoginForm'])->name('etudiantlogin');

// Traitement du login étudiant
Route::post('/etudiant/login', [EtudiantLoginController::class, 'login'])->name('etudiantlogin.submit');

// Déconnexion étudiant
Route::get('/etudiant/logout', [EtudiantLoginController::class, 'logout'])->name('etudiantlogout');

// Tableau de bord étudiant (protégé par middleware custom si tu veux)
// routes/web.php


Route::get('/etudiant/dashboard', [EtudiantDashboardController::class, 'index'])
    ->name('etudiant.dashboard');

