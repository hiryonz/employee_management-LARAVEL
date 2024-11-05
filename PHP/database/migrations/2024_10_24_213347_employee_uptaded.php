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
        Schema::create('employee', function (Blueprint $table) {
            $table->string('cedula')->primary();
            $table->string('nombre');
            $table->string('apellido');
            $table->String('edad');
            $table->date('nacimiento');
            $table->string('genero');
            $table->String('email');
            $table->string('telefono');
            $table->enum('departamento', [
                'recursos humano', 
                'finanzas', 
                'contabilidad', 
                'marketing', 
                'produccion', 
                'tecnologia', 
                'logistica', 
                'legal', 
                'atencion al cliente', 
                'sistemas'
            ]);
            $table->enum('tipo', ['admin','empleado']);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
