<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('interventions', function (Blueprint $table) {
            // Supprimer l'ancien champ
            $table->dropColumn('dateHeure');

            // Ajouter les deux nouveaux champs
            $table->dateTime('dateHeureDebut')->nullable();
            $table->dateTime('dateHeureFin')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('interventions', function (Blueprint $table) {
            // Remettre l'ancien champ
            $table->dateTime('dateHeure')->nullable();

            // Supprimer les nouveaux champs
            $table->dropColumn(['dateHeureDebut', 'dateHeureFin']);
        });
    }
};
