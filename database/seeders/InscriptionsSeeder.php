<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InscriptionsSeeder extends Seeder
{
    // La méthode run() est exécutée lorsque le seeder est lancé.
    public function run(): void
    {
        // Insertion manuelle des données dans la table "inscriptions"
        DB::table('inscriptions')->insert([
            [
                // Date de l'inscription (date actuelle)
                'date_inscription' => Carbon::now()->toDateString(),

                // Date prévue de début des cours (+1 jour)
                'date_de_debut' => Carbon::now()->addDays(1)->toDateString(),

                // Date prévue de fin des cours (+1 mois)
                'date_de_fin' => Carbon::now()->addMonth()->toDateString(),

                // Montant total à payer pour l'inscription
                'montant_total' => 150000,

                // Montant déjà versé par l'étudiant
                'montant_verse' => 50000,

                // Montant restant à payer
                'montant_restant' => 100000,

                // Statut de l'inscription : en cours, terminée, annulée, etc.
                'statut' => 'en cours',

                // Référence de l'étudiant (doit exister dans la table "etudiants")
                'id_etudiant' => 1,

                // Référence du niveau / cours choisi
                'id_niveaux' => 1,

                // Référence de la secrétaire (dans la table "users")
                'id_secretaire' => 1,

                // Dates automatiques de création et de mise à jour
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'date_inscription' => Carbon::now()->toDateString(),
                'date_de_debut' => Carbon::now()->addDays(2)->toDateString(),
                'date_de_fin' => Carbon::now()->addMonth()->toDateString(),
                'montant_total' => 70000,

                // Montant versé == 70000 (donc inscription entièrement payée)
                'montant_verse' => 700000,

                // Aucun reste à payer
                'montant_restant' => 0,

                // Statut : terminée (car tout est payé et inscription terminée)
                'statut' => 'terminée',

                'id_etudiant' => 2,   // Correspond à l’étudiant avec ID = 2
                'id_niveaux' => 2,    // Correspond au niveau ID = 2
                'id_secretaire' => 1, // Admin ou secrétaire

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
