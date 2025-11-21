<?php

// Importation de la classe Route pour définir les routes de l'application
use Illuminate\Support\Facades\Route;

// Contrôleur pour la gestion des étudiants (CRUD complet : créer, afficher, modifier, supprimer)
use App\Http\Controllers\EtudiantController;

// Contrôleur pour gérer les inscriptions des étudiants à un niveau ou formation
use App\Http\Controllers\InscriptionController;

// Contrôleur pour gérer les niveaux ou classes (exemple : Débutant, Intermédiaire, Avancé)
use App\Http\Controllers\NiveauController;

// Contrôleur pour la gestion des paiements (enregistrement, affichage, reçu, etc.)
use App\Http\Controllers\PaiementController;

// Contrôleur pour gérer les besoins ou demandes spécifiques des étudiants
use App\Http\Controllers\BesoinController;

// Contrôleur du Tableau de bord (statistiques, résumé des derniers paiements, inscriptions, besoins)
use App\Http\Controllers\DashboardController;

// Contrôleur d'authentification (connexion, inscription, déconnexion, gestion des utilisateurs)
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| ROUTES DES RESSOURCES PRINCIPALES (CRUD AUTOMATIQUE)
|--------------------------------------------------------------------------
| Toutes ces routes sont protégées par les contrôleurs correspondants.
| La méthode Route::resource() crée automatiquement 7 routes :
| index, create, store, show, edit, update, destroy.
|
| Exemples :
| GET     /etudiants        → index (liste)
| GET     /etudiants/create → create (formulaire)
| POST    /etudiants        → store (enregistrer)
| GET     /etudiants/{id}   → show (afficher)
| GET     /etudiants/{id}/edit → edit (modifier)
| PUT     /etudiants/{id}   → update (mettre à jour)
| DELETE  /etudiants/{id}   → destroy (supprimer)
*/
Route::resource('etudiants', EtudiantController::class);   // Gestion des étudiants
Route::resource('niveaux', NiveauController::class);       // Gestion des niveaux (classes ou filières)
Route::resource('inscriptions', InscriptionController::class); // Gestion des inscriptions d'étudiants
Route::resource('paiements', PaiementController::class);   // Gestion des paiements liés aux inscriptions
Route::resource('besoins', BesoinController::class);       // Gestion des besoins (demandes ou requêtes des étudiants)


/*
|--------------------------------------------------------------------------
| ROUTE DU TABLEAU DE BORD
|--------------------------------------------------------------------------
| Page principale après la connexion : affiche statistiques, derniers paiements,
| besoins récents, etc.
*/
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| ROUTES SPÉCIALES : GÉNÉRATION ET TÉLÉCHARGEMENT DE REÇU DE PAIEMENT
|--------------------------------------------------------------------------
| Ces routes ne font pas partie du CRUD standard.
| Elles permettent d'afficher et de télécharger un reçu PDF.
*/
Route::get('/paiements/{id}/recu', [PaiementController::class, 'recu'])
     ->name('paiements.recu');  // Affichage du reçu
     
Route::get('/paiements/{id}/recu-download', [PaiementController::class, 'downloadRecu'])
     ->name('paiements.recu.download');  // Télécharger le reçu en PDF


/*
|--------------------------------------------------------------------------
| ROUTES D'AUTHENTIFICATION (LOGIN / REGISTER / LOGOUT)
|--------------------------------------------------------------------------
| Ces routes permettent la connexion, la création de compte, et la déconnexion
*/
Route::get('/', [AuthController::class, 'showLoginForm'])
     ->name('login');  // Affiche la page de connexion

Route::post('/', [AuthController::class, 'login'])
     ->name('login.perform');  // Envoie du formulaire de connexion

Route::post('/logout', [AuthController::class, 'logout'])
     ->name('logout');  // Déconnexion sécurisée

Route::get('/register', [AuthController::class, 'showRegisterForm'])
     ->name('register');  // Affiche le formulaire d'inscription

Route::post('/register', [AuthController::class, 'register'])
     ->name('register.perform');  // Enregistrer un nouveau compte
