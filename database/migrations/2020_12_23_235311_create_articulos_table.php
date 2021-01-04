<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('SKU')->unique();
            $table->string('ClaveFabricante');
            $table->string('Nombre');
            $table->string('Descripcion');
            $table->decimal('Precio', 8, 2);
            $table->decimal('PrecioMayoreo', 8, 2);
            $table->integer('CantidadMayoreo');
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('categoria_id');
            $table->string('Color');
            $table->string('Tecnologia');
            $table->string('ficheTecnicaUrl')->nullable();
            $table->boolean('Activo');
            $table->timestamps();

            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('categoria_id')->references('id')->on('categoria_articulos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}
