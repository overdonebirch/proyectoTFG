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
        Schema::create('users', function (Blueprint $collection) {

            $collection->string('nombre');
            $collection->string('apellidos');
            $collection->string('email');
            $collection->string('dni',9)->maxLength(9);
            $collection->string('password');
            $collection->objectId('id_gimnasio');
            $collection->json('membresia');
            $collection->string('fecha_registro');
            $collection->boolean('empleado');
            $collection->boolean('administrador');

        });

        Schema::table('users', function (Blueprint $table) {
            $table->unique('email','email_users');
            $table->unique('dni','dni_users');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('email_users');
            $table->dropIndex('dni_users');
        });

        Schema::drop('users');
    }
};
