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
        Schema::create('incharge_task', function (Blueprint $table) {
            $table->id(); // Llave primaria de la tabla
            $table->string('cedula'); // Columna para la cédula
            $table->unsignedBigInteger('id_incharge'); // Columna para la clave foránea de task
            $table->timestamps();
        
            // Definición de claves foráneas
            $table->foreign('cedula', 'incharge_task_cedula_foreign5')
                  ->references('cedula')->on('employee')
                  ->onDelete('cascade');
            
            $table->foreign('id_incharge', 'incharge_task_id_incharge_foreign5')
                  ->references('id')->on('task')
                  ->onDelete('cascade');
        });
        
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incharge_task');
    }
};
