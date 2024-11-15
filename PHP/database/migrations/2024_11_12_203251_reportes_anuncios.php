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


        Schema::create('news', function(Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->foreign('cedula')->references('cedula')->on('employee')->onDelete('cascade');
            $table->date('fecha');
            $table->string('titulo');
            $table->string('descripcion');
            $table->string('archivo')->nullable();
            $table->string('mime')->nullable();
            $table->boolean('visto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     Schema::dropIfExists('news');
    }
};
