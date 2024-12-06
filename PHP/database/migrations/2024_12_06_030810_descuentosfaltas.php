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
        Schema::create('descuentosfaltas', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->date('fecha');
            $table->double('horas_faltas');
            $table->double('descuentos_faltas');
            $table->timestamps();
            $table->double('horas_extras');
            
            $table->foreign('cedula')->references('cedula')->on('employee')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descuentosfaltas');

    }
};
