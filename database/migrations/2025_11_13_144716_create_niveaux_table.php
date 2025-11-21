<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('niveaux', function (Blueprint $table) {
        $table->id('id_niveaux'); // Clé primaire auto-incrémentée
        $table->string('nom_niveaux', 100); // Nom du niveau (ex: Débutant, Intermédiaire, Avancé)
        $table->string('langue', 50); // Langue du cours (ex: Anglais, Français, Espagnol)
        $table->decimal('frais_total', 10, 2); // Montant total à payer pour le niveau
        $table->timestamps(); // Champs automatiques created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveaux');
    }
};
