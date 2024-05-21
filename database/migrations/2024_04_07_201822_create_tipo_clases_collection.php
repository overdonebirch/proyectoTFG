<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipo_clases', function (Blueprint $collection) {
            $collection->string("nombre");
            $collection->string("descripcion");
            $collection->boolean("clase_premium");
            $collection->double("costo_unico");
        });

        Schema::table('tipo_clases', function (Blueprint $table) {
            $table->unique('nombre','nombre_tipo_clase');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipo_clases', function (Blueprint $table) {
            $table->dropIndex('nombre_tipo_clase');

        });

        Schema::dropIfExists('tipo_clases');
    }
};
