<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;    // Importe le modèle Eloquent pour la table 'etudiants'
use Illuminate\Http\Request; // Importe la classe Request pour la gestion des données HTTP

class EtudiantController extends Controller
{
    /**
     * Affiche la liste paginée des étudiants et gère la recherche.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // 1. Récupère le terme de recherche de l'URL s'il est présent (ex: ?search=DUPONT)
        $search = $request->input('search');

        // 2. Démarre la requête Eloquent sur le modèle Etudiant
        $etudiants = Etudiant::when($search, function ($query, $search) {
            // Utilise la méthode 'when' de Laravel pour appliquer les clauses de recherche UNIQUEMENT si $search est non nul
            
            // Recherche si le 'nom' contient le terme de recherche (non sensible à la casse selon la base)
            $query->where('nom', 'LIKE', "%$search%")
                  // OU si le 'prenom' contient le terme de recherche
                  ->orWhere('prenom', 'LIKE', "%$search%");
        })
        // 3. Trie les résultats par l'ID de l'étudiant, du plus récent au plus ancien (DESC)
        ->orderBy('id_etudiant', 'DESC')
        // 4. Applique la pagination (10 résultats par page)
        ->paginate(10);

        // 5. Retourne la vue d'index en passant la collection paginée d'étudiants et le terme de recherche
        return view('etudiants.index', compact('etudiants', 'search'));
    }


    /**
     * Affiche le formulaire de création d'un nouvel étudiant.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('etudiants.create');
    }

    /**
     * Stocke un nouvel étudiant dans la base de données après validation.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Validation des données de la requête
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'date_de_naissance' => 'required|date',
            // 'telephone' est obligatoire et doit être unique dans la table 'etudiants'
            'telephone' => 'required|unique:etudiants',
            // 'email' est optionnel (nullable), doit être un email valide, et doit être unique
            'email' => 'nullable|email|unique:etudiants',
            'adresse' => 'nullable|string',
        ]);

        // 2. Création de l'enregistrement en base de données (nécessite $fillable dans le modèle Etudiant)
        Etudiant::create($request->all());

        // 3. Redirection vers la liste d'index avec un message de succès
        return redirect()->route('etudiants.index')->with('success', 'Étudiant ajouté avec succès');
    }

    /**
     * Affiche les détails d'un étudiant spécifique.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // 1. Récupère l'étudiant par son ID. Si non trouvé, lève une exception 404
        $etudiant = Etudiant::findOrFail($id); 
        
        // 2. Retourne la vue de détail avec l'objet étudiant
        return view('etudiants.show', compact('etudiant'));
    }

    /**
     * Affiche le formulaire d'édition pour un étudiant spécifique.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // 1. Récupère l'étudiant par son ID (findOrFail pour gestion d'erreur 404)
        $etudiant = Etudiant::findOrFail($id); 
        
        // 2. Retourne la vue d'édition avec l'objet étudiant
        return view('etudiants.edit', compact('etudiant'));
    }

    /**
     * Met à jour un étudiant spécifique dans la base de données.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // 1. Récupère l'étudiant existant
        $etudiant = Etudiant::findOrFail($id);

        // 2. Validation des données de la requête
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'date_de_naissance' => 'required|date',
            
            // Règle d'unicité pour le téléphone : 'unique:table,colonne,id_à_ignorer,colonne_clé'
            // Ceci permet d'ignorer l'étudiant actuel lors de la vérification d'unicité
            'telephone' => 'required|unique:etudiants,telephone,' . $id . ',id_etudiant',
            
            // Règle d'unicité pour l'email, ignorant l'enregistrement actuel
            'email' => 'nullable|email|unique:etudiants,email,' . $id . ',id_etudiant',
            
            'adresse' => 'nullable|string',
        ]);

        // 3. Mise à jour des données de l'étudiant
        $etudiant->update($request->all());

        // 4. Redirection vers l'index avec un message de succès
        return redirect()->route('etudiants.index')->with('success', 'Étudiant modifié avec succès');
    }

    /**
     * Supprime un étudiant spécifique de la base de données.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // 1. Récupère l'étudiant
        $etudiant = Etudiant::findOrFail($id);
        
        // 2. Suppression de l'enregistrement
        $etudiant->delete();

        // 3. Redirection vers l'index avec un message de succès
        return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé avec succès');
    }
}