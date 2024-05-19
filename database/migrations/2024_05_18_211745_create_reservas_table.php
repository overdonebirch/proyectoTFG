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
        Schema::create('reservas', function (Blueprint $table) {

            $table->string("dni_usuario",255);
            $table->string("id_clase",255);
            $table->string("id_gimnasio",255);
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');

        });

        Schema::table('reservas', function (Blueprint $table) {
            $table->unique(['dni_usuario', 'id_clase', 'id_gimnasio', 'fecha', 'hora_inicio', 'hora_fin'],'datos_reserva');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropIndex('datos_reserva');

        });

        Schema::dropIfExists('reservas');
    }
};
