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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->String('facturaVenta');
            $table->timestamp('fechaFactura');
            $table->unsignedBigInteger('idCliente'); // Clave foránea para la relación con la tabla 'clientes'
            $table->unsignedBigInteger('idUsuario');

            $table->unsignedBigInteger('idOrdenServicio');

            $table->decimal('subTotal', 10, 2);
            $table->decimal('deposito', 10, 2);
            $table->decimal('iva', 10, 2);
            $table->decimal('impuestoConsumo', 10, 2);
            $table->decimal('total', 10, 2);
            $table->char('estado');//F:facturado,P:pendiente,C:cancelado
            $table->char('medioPago');//E:efectivo,TC:tajeta de credito,TD:tajerta debito,TF:transferencia,B:bitcoin
            $table->decimal('valorPagado', 10, 2);
            $table->decimal('valorCambio', 10, 2);

            $table->foreign('idCliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('idUsuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idOrdenServicio')->references('id')->on('reservaciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
