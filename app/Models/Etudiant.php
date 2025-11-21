<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    // Nom de la table associée dans la base de données
    protected $table = 'etudiants';

    // Nom de la clé primaire de la table
    protected $primaryKey = 'id_etudiant';

    // Type de la clé primaire (ici un entier)
    protected $keyType = 'int';

    // Liste des colonnes autorisées à être remplies automatiquement
    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'date_de_naissance',
        'telephone',
        'email',
        'adresse',
        'date_enregistrement',
    ];

    // Relation : un étudiant peut avoir plusieurs inscriptions
    // (1 étudiant → plusieurs lignes dans la table inscriptions)
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'id_etudiant');
    }

    // Relation : un étudiant peut effectuer plusieurs paiements
    // (1 étudiant → plusieurs paiements liés à son id)
    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'id_etudiant');
    }

    // Relation : un étudiant peut exprimer plusieurs besoins
    // (1 étudiant → plusieurs besoins enregistrés)
    public function besoins()
    {
        return $this->hasMany(Besoin::class, 'id_etudiant');
    }
}
