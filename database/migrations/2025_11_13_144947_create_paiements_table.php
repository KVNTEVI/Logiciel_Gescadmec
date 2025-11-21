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
         Schema::create('paiements', function (Blueprint $table) {
            // Clé primaire
            $table->id('id_paiement');

            // Informations sur le paiement
            $table->decimal('montant', 10, 2); // montant payé
            $table->string('mode_paiement');   // espèce, mobile money, virement, etc.
            $table->date('date_paiement');     // date du paiement

            // Clé étrangère vers inscription
            $table->unsignedBigInteger('id_inscription');

            // Définition de la clé étrangère
            $table->foreign('id_inscription')->references('id_inscription')->on('inscriptions')->onDelete('cascade');

            // Horodatage automatique (created_at, updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
