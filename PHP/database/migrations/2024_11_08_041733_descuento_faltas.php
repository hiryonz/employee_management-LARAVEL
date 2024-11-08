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

        Schema::table('planillas', function(Blueprint $table) {
            $table->dropColumn('horas_faltas');
            $table->dropColumn('descuentos_faltas');
        });

        Schema::create('descuentosFaltas', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->constrained('employee')->onDelete('cascade');
            $table->date('fecha');
            $table->double('horas_faltas');
            $table->double('descuentos_faltas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('planillas', function(Blueprint $table) {
            $table->double('horas_faltas');
            $table->double('descuentos_falta');
        });

        Schema::dropIfExists('descuentosFaltas');
    }
};
