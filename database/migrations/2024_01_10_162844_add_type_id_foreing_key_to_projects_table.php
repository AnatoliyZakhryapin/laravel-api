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
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable()->after('id');

            $table->foreign('type_id')->references('id')->on('types')
                ->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // rimovere il vincolo della relazione
            // $table->dropForeign('projects_type_id_foreign');
               $table->dropForeign(['type_id']);

            // droppare la colonna type_id
            $table->dropColumn('type_id');
        });
    }
};
