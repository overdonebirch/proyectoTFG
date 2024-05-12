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
        Schema::create('suscripcions', function (Blueprint $table) {
            $table->string("id_cliente",255);
            $table->string("id_suscripcion",255);
        });

        Schema::table('suscripcions', function (Blueprint $table) {
            $table->unique('id_cliente','id_cliente_suscripcion');
            $table->unique('id_suscripcion','id_suscripcion_suscripcion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('suscripcions', function (Blueprint $table) {
            $table->dropIndex('id_cliente_suscripcion');
            $table->dropIndex('id_suscripcion_suscripcion');
        });

        Schema::dropIfExists('suscripcions');
    }

};
