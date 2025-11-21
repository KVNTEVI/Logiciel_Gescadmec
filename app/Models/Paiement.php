<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
      use HasFactory;

    // Nom de la table
    protected $table = 'paiements';

    // Clé primaire
    protected $primaryKey = 'id_paiement';

    // Type de la clé primaire
    protected $keyType = 'int';

    // Champs autorisés à être remplis
    protected $fillable = [
        'montant',
        'mode_paiement',
        'date_paiement',
        'id_inscription',
    ];

    //  Relation : un paiement appartient à une seule inscription
    public function inscription()
    {
        return $this->belongsTo(Inscription::class, 'id_inscription');
    }
}
