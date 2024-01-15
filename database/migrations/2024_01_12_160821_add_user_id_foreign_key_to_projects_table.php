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
            
            $table->unsignedBigInteger('user_id')->after('id');
           
            // onDelete - se utente viene eliminato tutti i suoi projects verrano eliminati. 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            $table->dropForeign('projects_user_id_foreign');
            // Se voglioamo fare riferimento direttamente sul nome di colonna dobbiamo mettere dentro un array
            // $table->dropForeign(['user_id']);

            $table->dropColumn('user_id');
        });
    }
};
