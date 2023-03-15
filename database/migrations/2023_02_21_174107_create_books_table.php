<?php

namespace Database\Migrations;

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
        Schema::create('books', function (Blueprint $table) {
            $table->id(); //asi tal cual es increments()
            //pero se podría poner $table->bigIncrements('id'); para hacerlo PK_AI id con tipo de datos BIGINT
            $table->string('isbn')->unique();
            $table->string('title');
            $table->string('author');
            $table->date('published_date');
            $table->text('description');
            $table->decimal('price');
            $table->timestamps(); //Crea dos columnas para el created_at y updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
