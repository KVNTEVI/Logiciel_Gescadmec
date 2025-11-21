<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;

    // Nom exact de la table dans la base de données
    protected $table = 'niveaux';

    // Nom de la clé primaire personnalisée
    protected $primaryKey = 'id_niveaux';
 
    // Type de la clé primaire
    protected $keyType = 'int';

    // Liste des champs qu'on peut remplir avec un formulaire ou un create()
    protected $fillable = [
        'nom_niveaux',
        'langue',
        'frais_total',
    ];
}
