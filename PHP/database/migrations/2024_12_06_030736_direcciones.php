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
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->string('ciudad');
            $table->string('codigo_postal');
            $table->string('provincia');
            $table->string('corregimiento');
            $table->string('distrito');
            $table->string('numero_casa');
            $table->text('descripcion');
            $table->timestamps();

            $table->foreign('cedula')->references('cedula')->on('employee')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direcciones');

    }
};
