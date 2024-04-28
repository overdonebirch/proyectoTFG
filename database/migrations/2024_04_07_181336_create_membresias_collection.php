<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mongodb';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('membresias', function (Blueprint $collection) {
            $collection->string('nombre');
            $collection->double('precio');
            $collection->array('periodos_meses');
            $collection->boolean('invitar_amigo');
            $collection->boolean('acceso_clases_basicas');
            $collection->boolean('acceso_clases_premium');
        });


        Schema::table('membresias', function (Blueprint $table) {
            $table->unique('nombre','nombre_membresia');
        });


    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('membresias', function (Blueprint $table) {
            $table->dropIndex('nombre_membresia');

        });

        Schema::dropIfExists('membresias');
    }
};
