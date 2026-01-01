<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->id('idIntervention');
            $table->dateTime('dateHeureDebut');
            $table->dateTime('dateHeureFin')->nullable();
            $table->text('description')->nullable();
            $table->enum('statut', ['en_attente', 'en_cours', 'terminee', 'annulee'])->default('en_attente');
            $table->text('commentaire')->nullable();

            // Clés étrangères vers machines et users
            $table->unsignedBigInteger('idMachine');
            $table->foreign('idMachine')->references('idMachine')->on('machines');

            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')->references('id')->on('users');

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
