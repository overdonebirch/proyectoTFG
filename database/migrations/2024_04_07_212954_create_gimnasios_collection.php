<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint;

return new class extends Migration
{
    protected $connection = 'mongodb';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gimnasios', function (Blueprint $collection) {
            $collection->string('nombre');
            $collection->string('direccion');
            $collection->string('horaApertura');
            $collection->string('horaCierre');
        });

        Schema::table('gimnasios', function (Blueprint $table) {
            $table->unique('nombre','nombre_gimnasio');
        });

    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {


        Schema::table('gimnasios', function (Blueprint $table) {
            $table->dropIndex('nombre_gimnasio');

        });

        Schema::drop('gimnasios');
    }
};
