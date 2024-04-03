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
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->id();
            $table->String('numeroOrden');
            $table->timestamp('fechaEvento');
            $table->unsignedBigInteger('idCliente'); // Clave foránea para la relación con la tabla 'clientes'
            $table->unsignedBigInteger('idUsuario');
            // Otras columnas
            $table->decimal('subTotal', 10, 2);
            $table->decimal('deposito', 10, 2);
            $table->decimal('iva', 10, 2);
            $table->decimal('impuestoConsumo', 10, 2);
            $table->decimal('total', 10, 2);
            $table->boolean('estado');
            $table->timestamps();

            $table->foreign('idCliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('idUsuario')->references('id')->on('users')->onDelete('cascade');
      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservaciones');
    }
};
