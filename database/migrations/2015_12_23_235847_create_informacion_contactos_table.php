<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformacionContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacion_contactos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre')->nullable();
            $table->string('Puesto')->nullable();
            $table->string('Direccion')->nullable();
            $table->string('Email')->nullable();
            $table->string('Telefono')->nullable();
            $table->string('TelefonoMovil')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informacion_contactos');
    }
}
