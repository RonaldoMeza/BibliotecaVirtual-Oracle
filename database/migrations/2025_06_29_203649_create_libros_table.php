<?php

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
        Schema::connection('oracle')->create('libros', function (Blueprint $table) {
            $table->id('id_libro');
            $table->string('titulo');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('category_id');
            $table->string('isbn')->unique();
            $table->date('publicacion')->nullable();
            // FKs
            $table->foreign('author_id')
                ->references('id')->on('authors');
            $table->foreign('category_id')
                ->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
