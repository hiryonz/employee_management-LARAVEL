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
        Schema::create('planillas', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->double('salario_h');
            $table->double('salario_bruto');
            $table->double('salario_neto');
            $table->double('seguro_social');
            $table->double('seguro_educativo');
            $table->double('impuesto_renta');
            $table->double('descuentos');
            $table->timestamps();
            $table->integer('hora_trabajada');

            $table->foreign('cedula')->references('cedula')->on('employee')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planillas');
    }
};
