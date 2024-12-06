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
        Schema::create('turno', function (Blueprint $table) {
            $table->id();
            $table->time('entrada')->unique();
            $table->time('salida')->unique();
            $table->timestamps();

            
        });

                // Insert inicial en la tabla turno
                DB::table('turno')->insert([
                    [
                        'id' => 1,
                        'entrada' => '08:00:00',
                        'salida' => '17:00:00',
                        'created_at' => '2024-11-08 13:00:00',
                        'updated_at' => '2024-11-08 22:00:00',
                    ],
                    [
                        'id' => 2,
                        'entrada' => '09:30:00',
                        'salida' => '18:30:00',
                        'created_at' => '2024-11-07 14:30:00',
                        'updated_at' => '2024-11-07 23:30:00',
                    ],
                    [
                        'id' => 3,
                        'entrada' => '07:45:00',
                        'salida' => '16:45:00',
                        'created_at' => '2024-11-06 12:45:00',
                        'updated_at' => '2024-11-06 21:45:00',
                    ],
                    [
                        'id' => 4,
                        'entrada' => '08:15:00',
                        'salida' => '17:15:00',
                        'created_at' => '2024-11-05 13:15:00',
                        'updated_at' => '2024-11-05 22:15:00',
                    ],
                    [
                        'id' => 5,
                        'entrada' => '10:00:00',
                        'salida' => '19:00:00',
                        'created_at' => '2024-11-04 15:00:00',
                        'updated_at' => '2024-11-05 00:00:00',
                    ],
                ]);
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turno');
    }
};
