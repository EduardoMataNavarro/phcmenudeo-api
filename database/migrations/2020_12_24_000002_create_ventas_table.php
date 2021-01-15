<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('Folio')->unique()->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('metodoenvio_id')->nullable();
            $table->unsignedBigInteger('metodopago_id')->nullable();
            $table->string('DireccionEnvio')->nullable();
            $table->decimal('Subtotal', 8, 2);
            $table->decimal('Total', 8, 2);
            $table->enum('Estatus', ['iniciada', 'terminada', 'cancelada', 'entregada']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('metodoenvio_id')->references('id')->on('metodo_envios');
            $table->foreign('metodopago_id')->references('id')->on('metodo_pagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
