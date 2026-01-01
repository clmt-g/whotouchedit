<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('intervention_planifiee_techniciens', function (Blueprint $table) {
            $table->unsignedBigInteger('idInterventionPlanifiee');
            $table->unsignedBigInteger('idUser');

            $table->primary(['idInterventionPlanifiee', 'idUser'], 'intervention_user_primary');

            $table->foreign('idInterventionPlanifiee', 'fk_intervention_planifiee')
                ->references('idInterventionPlanifiee')
                ->on('interventions_planifiees');

            $table->foreign('idUser', 'fk_user_technicien')
                ->references('id')
                ->on('users');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intervention_planifiee_techniciens');
    }
};
