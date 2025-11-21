<?php

// Déclaration du namespace : indique à Laravel que ce seeder se trouve dans le dossier "database/seeders"
namespace Database\Seeders;

// Importation des classes nécessaires
use Illuminate\Database\Seeder;        // Classe de base pour tous les seeders Laravel
use Illuminate\Support\Facades\DB;     // Permet d’interagir directement avec la base de données
use Illuminate\Support\Facades\Hash;   // Sert à hacher (sécuriser) les mots de passe avant insertion

// Définition de la classe du seeder pour la table "users"
class UsersSeeder extends Seeder
{
    // La méthode run() est automatiquement exécutée lorsque le seeder est lancé
    public function run(): void
    {
        // Insertion de plusieurs enregistrements dans la table "users"
        DB::table('users')->insert([

            // Premier utilisateur : l'administrateur principal
            [
                'name' => 'TEVI',          // Nom complet de l'utilisateur
                'email' => 'admin@gmail.com',       // Adresse e-mail unique
                'password' => Hash::make('admin123'), // Mot de passe chiffré grâce à la fonction Hash::make()
            ],

            // Deuxième utilisateur : une secrétaire
            [
                'name' => 'Sandra',
                'email' => 'secretaire@example.com',
                'password' => Hash::make('secret123'), // Mot de passe sécurisé également
            ],
        ]);
    }
}
