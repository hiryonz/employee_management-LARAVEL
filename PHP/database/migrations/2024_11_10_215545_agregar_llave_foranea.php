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
        Schema::table('direcciones', function (Blueprint $table) {
            $table->foreign('cedula', 'direcciones_cedula_foreign5')->references('cedula')->on('employee')->onDelete('cascade');
        });
    
        Schema::table('planillas', function (Blueprint $table) {
            $table->foreign('cedula', 'planillas_cedula_foreign5')->references('cedula')->on('employee')->onDelete('cascade');
        });
    
        Schema::table('employee', function (Blueprint $table) {
            $table->bigInteger('id_turno')->unsigned()->change();
            $table->foreign('id_turno', 'employee_id_turno_foreign5')->references('id')->on('turno')->onDelete('cascade');
        });
    
        Schema::table('entrada_salida', function (Blueprint $table) {
            $table->foreign('cedula', 'entrada_salida_cedula_foreign5')->references('cedula')->on('employee')->onDelete('cascade');
        });
    
        Schema::table('incharge_task', function (Blueprint $table) {   
            $table->bigInteger('id_incharge')->unsigned()->change();
 
            $table->foreign('cedula', 'incharge_task_cedula_foreign5')->references('cedula')->on('employee')->onDelete('cascade');
            $table->foreign('id_incharge', 'incharge_task_id_incharge_foreign5')->references('id')->on('task')->onDelete('cascade');
        });
    
        Schema::table('task', function (Blueprint $table) {
            $table->foreign('cedula', 'task_cedula_foreign5')->references('cedula')->on('employee')->onDelete('cascade');
        });
    
        Schema::table('descuentosfaltas', function (Blueprint $table) {
            $table->foreign('cedula', 'descuentosfaltas_cedula_foreign5')->references('cedula')->on('employee')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('direcciones', function (Blueprint $table) {
            $table->dropForeign(['cedula']);
        });

        Schema::table('planillas', function (Blueprint $table) {
            $table->dropForeign(['cedula']);
        });

        Schema::table('employee', function (Blueprint $table) {
            $table->dropForeign(['id_turno']);
        });

        Schema::table('entrada_salida', function (Blueprint $table) {
            $table->dropForeign(['cedula']);
        });

        Schema::table('incharge_task', function (Blueprint $table) {
            $table->dropForeign(['cedula']);
            $table->dropForeign(['id_incharge']);
        });

        Schema::table('task', function (Blueprint $table) {
            $table->dropForeign(['cedula']);
        });

        Schema::table('descuentosfaltas', function (Blueprint $table) {
            $table->dropForeign(['cedula']);
        });

    }
};
