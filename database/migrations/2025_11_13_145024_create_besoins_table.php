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
         Schema::create('besoins', function (Blueprint $table) {
            // Clé primaire
            $table->id('id_besoin');

            // Informations sur le besoin
            $table->text('description'); // contenu ou demande de l'étudiant
            $table->date('date_soumission'); // date à laquelle le besoin a été soumis

            // Clé étrangère vers la table etudiants
            $table->unsignedBigInteger('id_etudiant');

            // Définition de la contrainte de clé étrangère
            $table->foreign('id_etudiant')->references('id_etudiant')->on('etudiants')->onDelete('cascade');

            // Horodatage automatique (created_at, updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('besoins');
    }
};
