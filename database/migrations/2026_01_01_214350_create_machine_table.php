<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id('idMachine');
            $table->string('nom', 100);
            $table->string('reference', 50)->unique();
            $table->date('dateInstallation');
            $table->enum('etat', ['opérationnelle', 'en_maintenance', 'planifiée', 'en_panne', 'hors_service'])->default('opérationnelle');
            $table->enum('criticite', ['faible', 'moyen', 'critique'])->default('moyen');
            $table->string('localisation', 200);
            $table->string('notes')->nullable();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
