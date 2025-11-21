<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Inscription;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PaiementController extends Controller
{
    // Liste des paiements avec filtrage
    public function index(Request $request)
    {
        $nom = $request->input('nom');
        $mode_paiement = $request->input('mode_paiement');
        $date = $request->input('date');

        $paiements = Paiement::with('inscription.etudiant')
            ->when($nom, function ($query, $nom) {
                $query->whereHas('inscription.etudiant', function ($q) use ($nom) {
                    $q->where('nom', 'LIKE', "%$nom%")
                      ->orWhere('prenom', 'LIKE', "%$nom%");
                });
            })
            ->when($mode_paiement, function ($query, $mode_paiement) {
                $query->where('mode_paiement', $mode_paiement);
            })
            ->when($date, function ($query, $date) {
                $query->whereDate('date_paiement', $date);
            })
            ->latest()
            ->paginate(10);

        return view('paiements.index', compact('paiements', 'nom', 'mode_paiement', 'date'));
    }

    // Formulaire de création
    public function create()
    {
        $inscriptions = Inscription::with('etudiant')->get();
        return view('paiements.create', compact('inscriptions'));
    }

    // Enregistrer un paiement
    public function store(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric|min:0',
            'mode_paiement' => 'required|string',
            'date_paiement' => 'required|date',
            'id_inscription' => 'required|exists:inscriptions,id_inscription',
        ]);

        Paiement::create($request->all());

        return redirect()->route('paiements.index')
                         ->with('success', 'Paiement enregistré avec succès !');
    }

    // Affichage du PDF dans le navigateur
    public function recu($id)
    {
        $paiement = Paiement::with('inscription.etudiant')->findOrFail($id);
        $pdf = Pdf::loadView('paiements.recu', compact('paiement'));
        return $pdf->stream('Recu_Paiement_'.$paiement->id_paiement.'.pdf');
    }

    // Téléchargement direct du reçu
    public function downloadRecu($id)
    {
        $paiement = Paiement::with('inscription.etudiant')->findOrFail($id);
        $pdf = Pdf::loadView('paiements.recu', compact('paiement'));
        return $pdf->download('Recu_Paiement_'.$paiement->id_paiement.'.pdf');
    }

    public function show($id)
    {
        $paiement = Paiement::with('inscription.etudiant')->findOrFail($id);
        return view('paiements.show', compact('paiement'));
    }

    public function edit($id)
    {
        $paiement = Paiement::findOrFail($id);
        $inscriptions = Inscription::with('etudiant')->get();
        return view('paiements.edit', compact('paiement', 'inscriptions'));
    }

    public function update(Request $request, $id)
    {
        $paiement = Paiement::findOrFail($id);

        $request->validate([
            'montant' => 'required|numeric|min:0',
            'mode_paiement' => 'required|string',
            'date_paiement' => 'required|date',
            'id_inscription' => 'required|exists:inscriptions,id_inscription',
        ]);

        $paiement->update($request->all());

        return redirect()->route('paiements.index')
                        ->with('success', 'Paiement mis à jour avec succès.');
    }

    public function destroy($id)
    {
        Paiement::findOrFail($id)->delete();

        return redirect()->route('paiements.index')
                        ->with('success', 'Paiement supprimé avec succès.');
    }
}
