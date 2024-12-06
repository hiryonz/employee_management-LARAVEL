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
        Schema::create('entrada_salida', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->date('fecha');
            $table->time('hora_entrada');
            $table->time('hora_salida');
            $table->timestamps();

            $table->foreign('cedula')->references('cedula')->on('employee')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada_salida');

    }
};
