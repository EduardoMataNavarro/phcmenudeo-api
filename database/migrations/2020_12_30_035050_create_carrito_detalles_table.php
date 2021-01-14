<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito_detalles', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('carrito_id');
            $table->UnsignedBigInteger('articulo_id');
            $table->UnsignedBigInteger('sucursal_id')->nullable();
            $table->decimal('Cantidad', 8, 2);
            $table->timestamps();

            $table->foreign('carrito_id')->references('id')->on('carritos');
            $table->foreign('articulo_id')->references('id')->on('articulos');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrito_detalles');
    }
}
