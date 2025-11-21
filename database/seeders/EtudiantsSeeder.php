<?php

namespace Database\Seeders;

// Importation des classes nécessaires
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtudiantsSeeder extends Seeder
{
    // La méthode "run" s'exécute lorsqu'on lance le seeder avec "php artisan db:seed"
    public function run(): void
    {
        // Insertion de plusieurs enregistrements dans la table "etudiants"
        DB::table('etudiants')->insert([
            
            // Premier étudiant
            [
                'nom' => 'Tossou',                    // Nom de famille de l’étudiant
                'prenom' => 'Assouan Tossou',                   // Prénom de l’étudiant
                'sexe' => 'Masculin',                  // Sexe (Masculin ou Féminin)
                'date_de_naissance' => '2000-05-10',   // Date de naissance
                'telephone' => '90909090',             // Numéro de téléphone
                'email' => 'toss@gmail.com',      // Adresse e-mail de l’étudiant
                'adresse' => 'Bè-chateau',                   // Adresse de résidence
                'date_enregistrement' => now(),        // Date d’enregistrement (date/heure actuelle)
            ],

            // Deuxième étudiant
            [
                'nom' => 'ABBEY',
                'prenom' => 'Staël',
                'sexe' => 'Féminin',
                'date_de_naissance' => '2001-03-22',
                'telephone' => '90123456',
                'email' => 'absta@gmail.com',
                'adresse' => 'Adakpamé',
                'date_enregistrement' => now(),        // Enregistre la date du moment où le seed est exécuté
            ],
        ]);
    }
}
