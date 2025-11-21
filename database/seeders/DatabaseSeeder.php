<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // mot de passe : password
        ]);

        // La méthode "call()" permet d'exécuter plusieurs seeders à la suite.
    // Ici, on appelle plusieurs classes de seeders afin de peupler différentes tables de la base de données.
    $this->call([
        UsersSeeder::class,       // Appel du seeder pour insérer les utilisateurs (ex: admin, secrétaire)
        NiveauxSeeder::class,     // Appel du seeder pour insérer les différents niveaux de langue
        EtudiantsSeeder::class,   // Appel du seeder pour insérer les informations des étudiants
        InscriptionsSeeder::class, // Appel du seeder pour insérer les informations des inscriptions
    ]);
    }
}
