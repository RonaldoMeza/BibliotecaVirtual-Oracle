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
        Schema::connection('oracle')->create('prestamos', function (Blueprint $table) {
            $table->id('id_prestamo'); // crea secuencia automáticamente
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('libro_id');
            $table->date('fecha_prestamo');
            $table->date('fecha_devolucion')->nullable();
            $table->string('estado', 20)->default('PRESTADO'); // <-- nuevo campo

            // Claves foráneas
            $table->foreign('user_id')
                ->references('id')->on('users')->onDelete('cascade');
            $table->foreign('libro_id')
                ->references('id_libro')->on('libros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('oracle')->dropIfExists('prestamos');
    }
};
