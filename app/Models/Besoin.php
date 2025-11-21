<?php

namespace App\Models;

// Importation du trait HasFactory pour permettre la création de données factices (factory)
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Importation de la classe Model qui permet de représenter une table en base de données
use Illuminate\Database\Eloquent\Model;

class Besoin extends Model
{
    // Utilisation du trait HasFactory pour générer facilement des instances du modèle (tests, seeders, etc.)
    use HasFactory;

    // Nom exact de la table dans la base de données
    // Par défaut, Laravel utilise le nom du modèle au pluriel ('besoins'), mais ici on le précise par sécurité
    protected $table = 'besoins';

    // Clé primaire personnalisée
    // Laravel s'attend par défaut à 'id', mais ici elle s'appelle 'id_besoin'
    protected $primaryKey = 'id_besoin';

    // Type de la clé primaire
    // On précise que la clé primaire est un entier (int) — sinon Laravel la traite comme string par défaut
    protected $keyType = 'int';

    // Liste des champs pouvant être remplis automatiquement (création ou mise à jour)
    // Sécurise l'application en empêchant le remplissage non autorisé (Mass Assignment)
    protected $fillable = [
        'description',       // Description du besoin exprimé par l'étudiant
        'date_soumission',   // Date à laquelle le besoin a été soumis
        'id_etudiant',       // Clé étrangère vers l'étudiant concerné
    ];

    // Relation : un besoin appartient à un seul étudiant
    // belongsTo() indique que chaque Besoin est lié à un seul Etudiant via la clé étrangère 'id_etudiant'
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant');
    }
}
