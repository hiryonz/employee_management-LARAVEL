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
        Schema::table('task', function (Blueprint $table) {
            $table->string('estado')->default('nuevo')->after('prioridad');
            $table->string('estado_db')->default('abierto');
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
            $table->string('titulo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task', function (Blueprint $table) {
            $table->dropColumn('estado');
            $table->dropColumn('estado_db');
            $table->dropColumn('departamento');
            $table->dropColumn('titulo');
        });
    }
};
