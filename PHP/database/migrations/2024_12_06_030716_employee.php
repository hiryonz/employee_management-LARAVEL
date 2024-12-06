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
            $table->longText('profile_image')->nullable();
            $table->string('image_mime')->nullable();
            $table->string('edad');
            $table->date('nacimiento');
            $table->string('genero');
            $table->string('email');
            $table->string('telefono');
            $table->enum('departamento', ['recursos humano', 'finanzas', 'contabilidad', 'marketing', 'produccion', 'tecnologia', 'logistica', 'legal', 'atencion al cliente', 'sistemas']);
            $table->enum('tipo', ['admin', 'empleado']);
            $table->timestamps();
            $table->unsignedBigInteger('id_turno');

            $table->foreign('id_turno')->references('id')->on('turno')->onDelete('cascade');
        });

        // Insert inicial
        DB::table('employee')->insert([
            ['cedula' => '1', 'tipo' => 'admin', 'nombre' => 'Admin', 'apellido' => 'Usuario', 'edad' => '30', 'nacimiento' => '1994-01-01', 'genero' => 'M', 'email' => 'admin@example.com', 'telefono' => '123456789', 'departamento' => 'sistemas', 'id_turno' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');

    }
};
