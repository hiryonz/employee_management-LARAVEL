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
        Schema::table('turno', function(Blueprint $table) {
            $table->time('entrada')->change()->unique();
            $table->time('salida')->change()->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('turno', function (Blueprint $table) {
            // Revertir las columnas de DATETIME a DATE
            $table->date('entrada')->change()->unique();
            $table->date('salida')->change()->unique();
        });
    }
};
