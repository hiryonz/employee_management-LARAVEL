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
        Schema::table('incharge_task', function (Blueprint $table) {
            $table->timestamps(); // Agregar columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incharge_task', function (Blueprint $table) {
            $table->dropTimestamps(); // Eliminar las columnas si se deshace la migración
        });
    }
};
