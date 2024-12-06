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
        Schema::create('login_user', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->unique();
            $table->string('user')->unique();
            $table->string('password');
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();

            $table->foreign('cedula')->references('cedula')->on('employee')->onDelete('cascade');
        });

        // Insert inicial
        DB::table('login_user')->insert([
            ['cedula' => '1', 'user' => 'admin', 'password' => bcrypt('admin'), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_user');

    }
};
