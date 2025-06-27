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
        Schema::create('gps_ubicacions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('bus_id');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->decimal('latitud', 10, 6);
            $table->decimal('longitud', 10, 6);
            $table->float('velocidad_kmh', 6, 2)->nullable();
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
        Schema::dropIfExists('gps_ubicacions');
    }
};
