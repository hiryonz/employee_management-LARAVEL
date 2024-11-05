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
                $table->integer('edad');
                $table->date('nacimiento');
                $table->string('genero');
                $table->string('email');
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



        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->constrained('employee')->onDelete('cascade');
            $table->string('ciudad');
            $table->string('codigo_postal');
            $table->string('pais');
            $table->string('provincia');
            $table->string('corregimiento');
            $table->string('calle');
            $table->string('numero_casa');
            $table->text('descripcion');
            $table->timestamps();
        });

        Schema::create('planillas', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->constrained('employee')->onDelete('cascade');
            $table->double('salario_h');
            $table->double('salario_bruto');
            $table->double('salario_neto');
            $table->double('seguro_social');
            $table->double('seguro_educativo');
            $table->double('impuesto_renta');
            $table->double('descuentos');
            $table->double('descuentos_faltas')->default(0);
            $table->double('horas_faltas')->default(0);
            $table->timestamps();
        });


        Schema::create('entrada_salida', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->constrained('employee')->onDelete('cascade');
            $table->string('id_turno')->constrained('turno')->onDelete('cascade');
            $table->date('fecha');
            $table->time('hora_entrada');
            $table->time('hora_salida');
            $table->timestamps();
        });


        Schema::create('incharge_task', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->constrained('employee')->onDelete('cascade');
            $table->string('id_incharge')->constrained('task')->onDelete('cascade');
            

        });

        Schema::create('task', function(Blueprint $table) {
            $table->id();
            $table->string('cedula')->constrained('employee')->onDelete('cascade');
            $table->text('descripcion');

            $table->enum('prioridad',['alta','media','baja']);
            $table->date('fecha_creacion');
            $table->date('fecha_limite');
            $table->timestamps();

            


        });

        Schema::create('turno', function(Blueprint $table) {
            $table->id();
            $table->date('entrada')->unique();
            $table->date('salida')->unique();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada_salida');
        Schema::dropIfExists('planillas');
        Schema::dropIfExists('direcciones');
        Schema::dropIfExists('incharge_task');
        Schema::dropIfExists('task');
        Schema::dropIfExists('turno');
        Schema::dropIfExists('employee');
    }
};
