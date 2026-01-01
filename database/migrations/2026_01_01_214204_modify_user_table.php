<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['technicien', 'responsable', 'admin', 'direction'])->default('technicien')->after('email');
            $table->string('prenom', 100)->after('name');
            $table->renameColumn('name', 'nom');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'prenom']);
        });
    }
};
