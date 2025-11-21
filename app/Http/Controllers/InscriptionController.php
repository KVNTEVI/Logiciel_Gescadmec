<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Etudiant;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscriptionController extends Controller
{
    // Liste des inscriptions
   public function index(Request $request)
{
    // Récupérer les valeurs des filtres
    $nom = $request->input('nom');
    $niveau = $request->input('niveau');
    $statut = $request->input('statut');

    // Construire la requête avec conditions dynamiques
    $inscriptions = Inscription::with(['etudiant', 'niveau'])
        ->when($nom, function ($query, $nom) {
            $query->whereHas('etudiant', function ($q) use ($nom) {
                $q->where('nom', 'LIKE', "%$nom%")
                  ->orWhere('prenom', 'LIKE', "%$nom%");
            });
        })
        ->when($niveau, function ($query, $niveau) {
            $query->where('id_niveaux', $niveau);
        })
        ->when($statut, function ($query, $statut) {
            $query->where('statut', $statut);
        })
        ->orderBy('id_inscription', 'DESC')
        ->paginate(10);

    // Récupération de la liste des niveaux pour le select
    $niveauxList = Niveau::orderBy('nom_niveaux')->get();

    // Envoi à la vue
    return view('inscriptions.index', compact('inscriptions', 'nom', 'niveau', 'statut', 'niveauxList'));
}


    // Formulaire création
    public function create()
    {
        $etudiants = Etudiant::orderBy('nom')->get();
        $niveaux   = Niveau::orderBy('id_niveaux')->get();

        return view('inscriptions.create', compact('etudiants', 'niveaux'));
    }

    // Enregistrer inscription
    public function store(Request $request)
    {
        $request->validate([
            'date_inscription' => 'required|date',
            'date_de_debut' => 'required|date',
            'date_de_fin' => 'required|date',
            'montant_total' => 'required|numeric|min:0',
            'montant_verse' => 'required|numeric|min:0',
            'statut' => 'string',
            'id_etudiant' => 'required|exists:etudiants,id_etudiant',
            'id_niveaux' => 'required|exists:niveaux,id_niveaux',
        ]);

        $montant_restant = $request->montant_total - $request->montant_verse;

        Inscription::create([
            'date_inscription' => $request->date_inscription,
            'date_de_debut' => $request->date_de_debut,
            'date_de_fin' => $request->date_de_fin,
            'montant_total' => $request->montant_total,
            'montant_verse' => $request->montant_verse,
            'montant_restant' => $montant_restant,
            'statut' => ($montant_restant <= 0) ? 'payé' : 'en cours',
            'id_etudiant' => $request->id_etudiant,
            'id_niveaux' => $request->id_niveaux,
            'id_secretaire' => Auth::id(),
        ]);

        return redirect()->route('inscriptions.index')->with('success', 'Inscription enregistrée avec succès.');
    }

    // Afficher une inscription
    public function show($id)
    {
        $inscription = Inscription::with(['etudiant', 'niveau'])->findOrFail($id);
        return view('inscriptions.show', compact('inscription'));
    }

    // Formulaire modification
    public function edit($id)
    {
        $inscription = Inscription::findOrFail($id);
        $etudiants   = Etudiant::orderBy('nom')->get();
        $niveaux     = Niveau::orderBy('id_niveaux')->get();

        return view('inscriptions.edit', compact('inscription', 'etudiants', 'niveaux'));
    }

    // Mise à jour
    public function update(Request $request, $id)
    {
        $inscription = Inscription::findOrFail($id);

        $request->validate([
            'date_inscription' => 'required|date',
            'date_de_debut' => 'required|date',
            'date_de_fin' => 'required|date',
            'montant_total' => 'required|numeric|min:0',
            'montant_verse' => 'required|numeric|min:0',
            'id_etudiant' => 'required|exists:etudiants,id_etudiant',
            'id_niveaux' => 'required|exists:niveaux,id_niveaux',
        ]);

        $montant_restant = $request->montant_total - $request->montant_verse;

        $inscription->update([
            'date_inscription' => $request->date_inscription,
            'date_de_debut' => $request->date_de_debut,
            'date_de_fin' => $request->date_de_fin,
            'montant_total' => $request->montant_total,
            'montant_verse' => $request->montant_verse,
            'montant_restant' => $montant_restant,
            'statut' => ($montant_restant <= 0) ? 'payé' : 'en cours',
            'id_etudiant' => $request->id_etudiant,
            'id_niveaux' => $request->id_niveaux,
        ]);

        return redirect()->route('inscriptions.index')->with('success', 'Inscription mise à jour.');
    }

    // Suppression
    public function destroy($id)
    {
        Inscription::findOrFail($id)->delete();
        return redirect()->route('inscriptions.index')->with('success', 'Inscription supprimée.');
    }


}
