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
        Schema::create('factura_configuracions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('resolucion');
            $table->integer('facturaInicia');
            $table->integer('facturaFinal');
            $table->integer('numero');
            $table->char('estado');//A:Activo,I:inactivo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_configuracions');
    }
};
