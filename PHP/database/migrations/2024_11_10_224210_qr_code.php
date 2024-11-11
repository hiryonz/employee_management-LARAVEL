<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('QR_code', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->foreign('cedula')->references('cedula')->on('employee')->onDelete('cascade');         
            $table->string('authcode');
            $table->string('qr_code');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('QR_code');
    }
};
