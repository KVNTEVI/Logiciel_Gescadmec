<?php

// Déclaration du namespace : permet à Laravel de savoir où se trouve ce seeder
namespace Database\Seeders;

// Importation des classes nécessaires
use Illuminate\Database\Seeder;       // Classe de base pour tous les seeders
use Illuminate\Support\Facades\DB;    // Facade qui permet d'interagir avec la base de données

// Définition de la classe NiveauxTableSeeder
// Elle étend (hérite) de la classe Seeder, donc Laravel sait qu'elle sert à insérer des données
class NiveauxSeeder extends Seeder
{
    // La méthode run() est automatiquement exécutée lorsque ce seeder est lancé
    public function run(): void
    {
        // Insertion de plusieurs enregistrements dans la table "niveaux"
        DB::table('niveaux')->insert([

            // Premier enregistrement : niveau débutant en anglais
            [
                'nom_niveaux' => 'Débutant',   // Nom du niveau
                'langue' => 'Anglais',         // Langue concernée
                'frais_total' => 50000,        // Coût total du niveau
            ],

            // Deuxième enregistrement : niveau intermédiaire en anglais
            [
                'nom_niveaux' => 'Intermédiaire',
                'langue' => 'Anglais',
                'frais_total' => 70000,
            ],

            // Troisième enregistrement : niveau avancé en français
            [
                'nom_niveaux' => 'Avancé',
                'langue' => 'Français',
                'frais_total' => 90000,
            ],
        ]);
    }
}
