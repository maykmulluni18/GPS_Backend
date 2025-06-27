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
        Schema::create('recarga_combustibles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('bus_id');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->float('litros_cargados', 8, 2);
            $table->date('fecha_recarga');
            $table->time('hora_recarga');
            $table->text('observacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recarga_combustibles');
    }
};
