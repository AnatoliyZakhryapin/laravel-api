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
        Schema::create('project_tecnology', function (Blueprint $table) {
            // Creamo le colonne in tabela ponte
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('tecnology_id');

            // Creamo il collegamento tra tabella
            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->foreign('tecnology_id')->references('id')->on('tecnologies')->cascadeOnDelete();

            $table->primary(['project_id', 'tecnology_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_tecnology');
    }
};
