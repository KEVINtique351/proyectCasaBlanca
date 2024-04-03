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
        Schema::create('reservaciones_detalle_salones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->String('numeroOrden');
            $table->unsignedBigInteger('idOrden');
            $table->unsignedBigInteger('idSalon');
            $table->decimal('dia', 10, 2);
            $table->decimal('cantidad', 10, 2);
            $table->decimal('valorUnitario', 10, 2);
            $table->decimal('valorTotal', 10, 2);

            $table->foreign('idOrden')->references('id')->on('reservaciones')->onDelete('cascade');
            $table->foreign('idSalon')->references('id')->on('salons')->onDelete('cascade');
  
        });

        Schema::create('reservaciones_detalle_servicios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->String('numeroOrden');
            $table->unsignedBigInteger('idOrden');
            $table->unsignedBigInteger('idServicio');
            $table->decimal('dia', 10, 2);
            $table->decimal('cantidad', 10, 2);
            $table->decimal('valorUnitario', 10, 2);
            $table->decimal('valorTotal', 10, 2);

            $table->foreign('idOrden')->references('id')->on('reservaciones')->onDelete('cascade');
            $table->foreign('idServicio')->references('id')->on('servicio')->onDelete('cascade');
  
        });

        Schema::create('reservaciones_detalle_otros', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->String('numeroOrden');
            $table->unsignedBigInteger('idOrden');
            $table->unsignedBigInteger('idOtros');
            $table->decimal('dia', 10, 2);
            $table->decimal('cantidad', 10, 2);
            $table->decimal('valorUnitario', 10, 2);
            $table->decimal('valorTotal', 10, 2);
            
            $table->foreign('idOrden')->references('id')->on('reservaciones')->onDelete('cascade');
            $table->foreign('idOtros')->references('id')->on('otroservicio')->onDelete('cascade');
  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservaciones_detalle_salones');
        Schema::dropIfExists('reservaciones_detalle_servicios');
        Schema::dropIfExists('reservaciones_detalle_otros');
    }
};
