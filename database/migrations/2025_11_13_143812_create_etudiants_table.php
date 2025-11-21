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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id('id_etudiant'); // Clé primaire personnalisée
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->enum('sexe', ['Masculin', 'Féminin']); // Enum pour le genre
            $table->date('date_de_naissance');
            $table->string('telephone', 20)->unique();
            $table->string('email', 150)->unique()->nullable();
            $table->string('adresse', 255)->nullable();
            $table->dateTime('date_enregistrement')->useCurrent(); // Date automatique d’ajout
            $table->timestamps(); // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
