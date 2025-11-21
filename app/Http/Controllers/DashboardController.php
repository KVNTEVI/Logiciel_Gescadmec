<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Besoin;

class DashboardController extends Controller
{
    public function index()
{
    // 5 derniers paiements
    $paiements = Paiement::with('inscription.etudiant')
        ->orderBy('date_paiement', 'desc')
        ->take(5)
        ->get();

    // 5 derniers besoins
    $besoins = Besoin::with('etudiant')
        ->orderBy('date_soumission', 'desc')
        ->take(5)
        ->get();

    // Compteurs
    $totalEtudiants = \App\Models\Etudiant::count();
    $totalPaiements = \App\Models\Paiement::count();
    $totalBesoins = \App\Models\Besoin::count();

    return view('dashboard.index', compact(
        'paiements',
        'besoins',
        'totalEtudiants',
        'totalPaiements',
        'totalBesoins'
    ));
}




}
