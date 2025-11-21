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
        Schema::create('inscriptions', function (Blueprint $table) {
            // Clé primaire
            $table->id('id_inscription');

            // Informations sur l'inscription
            $table->date('date_inscription');
            $table->date('date_de_debut');
            $table->date('date_de_fin');
            $table->decimal('montant_total', 10, 2);
            $table->decimal('montant_verse', 10, 2)->default(0);
            $table->decimal('montant_restant', 10, 2)->default(0);
            $table->string('statut')->default('en cours');

            // Clés étrangères
            $table->unsignedBigInteger('id_etudiant');
            $table->unsignedBigInteger('id_niveaux');
            $table->unsignedBigInteger('id_secretaire');

            // Définition des relations (clés étrangères)
            $table->foreign('id_etudiant')->references('id_etudiant')->on('etudiants')->onDelete('cascade');
            $table->foreign('id_niveaux')->references('id_niveaux')->on('niveaux')->onDelete('cascade');
            $table->foreign('id_secretaire')->references('id')->on('users')->onDelete('cascade');

            // Horodatage automatique (created_at, updated_at)
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
     public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
