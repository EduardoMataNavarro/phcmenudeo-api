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
            $table->string('Folio')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('metodoenvio_id');
            $table->unsignedBigInteger('metodopago_id');
            $table->decimal('Total', 8, 2);
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
