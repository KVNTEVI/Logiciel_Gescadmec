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

    // Enregistrer le paiement
    $paiement = Paiement::create($request->all());

    // Récupérer l'inscription liée
    $inscription = Inscription::findOrFail($request->id_inscription);

    // Nouveau montant total versé
    $nouveauMontantVerse = $inscription->montant_verse + $request->montant;

    // Montant restant
    $nouveauMontantRestant = $inscription->montant_total - $nouveauMontantVerse;

    // Mise à jour de l'inscription
    $inscription->update([
        'montant_verse'   => $nouveauMontantVerse,
        'montant_restant' => $nouveauMontantRestant,
        'statut'          => ($nouveauMontantRestant <= 0) ? 'payé' : 'en cours',
    ]);

    return redirect()->route('paiements.index')
                     ->with('success', 'Paiement enregistré et statut mis à jour !');
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

        $oldInscription = $paiement->id_inscription;

        // Mise à jour du paiement
        $paiement->update($request->all());

        // Recalcul pour l’ancienne inscription si elle a changé
        if ($oldInscription != $request->id_inscription) {
            $this->updateInscriptionAmounts($oldInscription);
        }

        // Mise à jour de la nouvelle inscription
        $this->updateInscriptionAmounts($request->id_inscription);

        return redirect()->route('paiements.index')
                        ->with('success', 'Paiement mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $paiement = Paiement::findOrFail($id);
        $inscriptionId = $paiement->id_inscription;

        $paiement->delete();

        // Mise à jour de l'inscription
        $this->updateInscriptionAmounts($inscriptionId);

        return redirect()->route('paiements.index')
                        ->with('success', 'Paiement supprimé avec succès.');
    }

    /**
     * 🔥 Fonction qui recalcule :
     * - montant_verse
     * - montant_restant
     * - statut
     */
    private function updateInscriptionAmounts($inscriptionId)
    {
        $inscription = Inscription::find($inscriptionId);

        if (!$inscription) return;

        $montant_verse_total = Paiement::where('id_inscription', $inscriptionId)->sum('montant');
        $montant_restant = $inscription->montant_total - $montant_verse_total;

        $inscription->update([
            'montant_verse' => $montant_verse_total,
            'montant_restant' => $montant_restant,
            'statut' => ($montant_restant <= 0) ? 'payé' : 'en cours',
        ]);
    }
}
