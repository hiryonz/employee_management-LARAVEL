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
        Schema::table('entrada_salida', function(Blueprint $table) {
            $table->dropColumn('id_turno');
        });

        Schema::table('employee', function(Blueprint $table) {
            $table->string('id_turno')->constrained('turno')->onDelete('cascade');    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entrada_salida', function(Blueprint $table) {
            $table->string('id_columna')->constrained('turno')->onDelete('cascade');
        });

        Schema::table('employee', function(Blueprint $table) {
            $table->dropColumn('id_turno');
        });
    }
};
