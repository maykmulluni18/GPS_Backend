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
        Schema::create('consumo_estimados', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('bus_id');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->float('km_recorridos', 8, 3);
            $table->float('litros_consumidos', 8, 3);
            $table->float('porcentaje_consumido', 5, 2);
            $table->date('fecha');
            $table->time('hora');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumo_estimados');
    }
};
