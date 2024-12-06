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
            $table->id();
            $table->string('cedula');
            $table->unsignedBigInteger('id_incharge');
            $table->timestamps();

            $table->foreign('cedula')->references('cedula')->on('employee')->onDelete('cascade');
            $table->foreign('id_incharge')->references('id')->on('task')->onDelete('cascade');
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
