<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            
            // creo l'effettiva colonna 
            $table->unsignedBigInteger('type_id')->nullable()->after('id');

            // assegno i riferimenti della colonna
            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            
            // elimino i riferimenti
            $table->dropForeign('projects_type_id_foreign');

            // elimino la colonna
            $table->dropColumn('type_id');
        });
    }
};
