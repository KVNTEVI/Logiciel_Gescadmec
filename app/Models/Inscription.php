<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    // Nom exact de la table
    protected $table = 'inscriptions';

    // Nom de la clé primaire
    protected $primaryKey = 'id_inscription';

    // Type de la clé primaire
    protected $keyType = 'int';

    // Liste des champs que l'on peut remplir
    protected $fillable = [
        'date_inscription',
        'date_de_debut',
        'date_de_fin',
        'montant_total',
        'montant_verse',
        'montant_restant',
        'statut',
        'id_etudiant',
        'id_niveaux',
        'id_secretaire',
    ];

    // ==========================
    // Relations entre tables
    // ==========================

    // Une inscription appartient à un étudiant
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant');
    }

    // Une inscription concerne un niveau
    public function niveau()
    {
        return $this->belongsTo(Niveau::class, 'id_niveaux');
    }

    // Une inscription est enregistrée par une secrétaire (utilisateur)
    public function secretaire()
    {
        return $this->belongsTo(User::class, 'id_secretaire');
    }
}
