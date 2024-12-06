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
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->text('descripcion');
            $table->enum('prioridad', ['alta', 'media', 'baja']);
            $table->string('estado')->default('nuevo');
            $table->date('fecha_creacion');
            $table->date('fecha_limite');
            $table->timestamps();
            $table->string('estado_db')->default('abierto');
            $table->enum('departamento', ['recursos humano', 'finanzas', 'contabilidad', 'marketing', 'produccion', 'tecnologia', 'logistica', 'legal', 'atencion al cliente', 'sistemas']);
            $table->string('titulo');

            $table->foreign('cedula')->references('cedula')->on('employee')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task');

    }
};
