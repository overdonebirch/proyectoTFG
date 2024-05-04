<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string("id",255);
            $table->string("name",255);
            $table->string("description",255);
            $table->string("type",255);
            $table->string("category",255);
            $table->string("image_url",255);
            $table->string("home_url",255);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->unique('id','id_product');
            $table->unique('name','name_product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_collection');
    }
};
