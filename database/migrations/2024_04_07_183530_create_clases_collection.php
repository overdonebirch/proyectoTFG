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
        Schema::create('clases', function (Blueprint $collection) {

           $collection->string("nombre");
           $collection->index("gimnasios");
           $collection->json("tipo_clase");

        });

        Schema::table('clases', function (Blueprint $table) {
            $table->unique('nombre','nombre_clase');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('clases', function (Blueprint $table) {
            $table->dropIndex('nombre_clase');

        });
        Schema::dropIfExists('clases');
    }
};
