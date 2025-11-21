<?php

namespace App\Http\Controllers;

use App\Models\Besoin;      // Importe le modèle Eloquent pour les besoins
use App\Models\Etudiant;    // Importe le modèle Eloquent pour les étudiants
use Illuminate\Http\Request; // Importe la classe Request pour gérer les requêtes HTTP

class BesoinController extends Controller
{
    /**
     * Affiche une liste des ressources (Besoins).
     * Permet également la recherche et l'affichage des relations.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // 1. Initialise la requête Eloquent et charge la relation 'etudiant' (Eager Loading)
        $query = Besoin::with('etudiant');

        // 2. Logique de recherche (filtre par nom ou prénom de l'étudiant)
        if ($request->filled('search')) {
            $search = $request->search;
            
            // Applique une contrainte sur la relation 'etudiant' (whereHas)
            $query->whereHas('etudiant', function ($q) use ($search) {
                // Recherche dans le nom (LIKE %terme%)
                $q->where('nom', 'like', "%$search%")
                  // Recherche dans le prénom (OU dans le prénom)
                  ->orWhere('prenom', 'like', "%$search%");
            });
        }

        // 3. Exécute la requête : trie par date de création descendante (latest) et récupère tous les résultats
        $besoins = $query->latest()->get();

        // 4. Retourne la vue d'index avec les données des besoins
        return view('besoins.index', compact('besoins'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle ressource (Besoin).
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Récupère tous les étudiants pour remplir la liste déroulante (select box) dans le formulaire
        $etudiants = Etudiant::all();
        
        return view('besoins.create', compact('etudiants'));
    }

    /**
     * Stocke une nouvelle ressource (Besoin) dans la base de données.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Validation des données de la requête
        $request->validate([
            'description' => 'required|string',
            'date_soumission' => 'required|date',
            // Vérifie que l'id existe dans la colonne 'id_etudiant' de la table 'etudiants'
            'id_etudiant' => 'required|exists:etudiants,id_etudiant', 
        ]);

        // 2. Création de l'enregistrement en base de données (nécessite $fillable dans le modèle Besoin)
        Besoin::create($request->all());

        // 3. Redirection vers la page d'index avec un message de succès (message flash)
        return redirect()->route('besoins.index')->with('success', 'Besoin ajouté avec succès.');
    }

    /**
     * Affiche la ressource spécifique (Besoin).
     *
     * @param \App\Models\Besoin $besoin (Utilisation du Model Binding implicite de Laravel)
     * @return \Illuminate\View\View
     */
    public function show(Besoin $besoin)
    {
        return view('besoins.show', compact('besoin'));
    }

    /**
     * Affiche le formulaire d'édition de la ressource spécifique.
     *
     * @param \App\Models\Besoin $besoin (Model Binding)
     * @return \Illuminate\View\View
     */
    public function edit(Besoin $besoin)
    {
        // Récupère tous les étudiants pour le formulaire d'édition
        $etudiants = Etudiant::all();
        
        return view('besoins.edit', compact('besoin', 'etudiants'));
    }

    /**
     * Met à jour la ressource spécifique dans la base de données.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Besoin $besoin (Model Binding)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Besoin $besoin)
    {
        // 1. Validation des données (mêmes règles que pour le store)
        $request->validate([
            'description' => 'required|string',
            'date_soumission' => 'required|date',
            'id_etudiant' => 'required|exists:etudiants,id_etudiant',
        ]);

        // 2. Mise à jour de l'enregistrement existant
        $besoin->update($request->all());

        // 3. Redirection vers la page d'index avec un message de succès
        return redirect()->route('besoins.index')->with('success', 'Modification enregistrée.');
    }

    /**
     * Supprime la ressource spécifique de la base de données.
     *
     * @param \App\Models\Besoin $besoin (Model Binding)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Besoin $besoin)
    {
        // 1. Suppression de l'enregistrement
        $besoin->delete();
        
        // 2. Redirection vers la page d'index avec un message de succès
        return redirect()->route('besoins.index')->with('success', 'Besoin supprimé.');
    }
}