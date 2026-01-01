<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interventions_planifiees', function (Blueprint $table) {
            $table->id('idInterventionPlanifiee');
            $table->dateTime('dateDebut');
            $table->dateTime('dateFin');
            $table->enum('type', ['préventive', 'contrôle périodique', 'calibration', 'amelioration']);
            $table->text('description');
            $table->enum('statut', ['planifiee', 'en_cours', 'terminee', 'annulee'])->default('planifiee');
            $table->enum('frequence', ['quotidienne', 'hebdomadaire', 'mensuelle', 'trimestrielle', 'annuelle', 'ponctuelle']);

            // Clé étrangère vers machines
            $table->unsignedBigInteger('idMachine');
            $table->foreign('idMachine')->references('idMachine')->on('machines');

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interventions_planifiees');
    }
};
