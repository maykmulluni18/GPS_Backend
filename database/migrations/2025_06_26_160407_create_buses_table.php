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
        Schema::create('buses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('placa')->unique();
            $table->string('modelo')->nullable();
            $table->integer('anio')->nullable();
            $table->float('capacidad_tanque', 8, 2); // litros
            $table->float('consumo_por_km', 8, 3);   // litros por km
            $table->enum('estado', ['activo', 'inactivo', 'mantenimiento'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
