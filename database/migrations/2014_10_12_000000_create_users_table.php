<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->string('RFC');
            $table->string('Correo')->unique();
            $table->string('Password');
            $table->string('Direccion');
            $table->unsignedBigInteger('rol_id');
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('sucursal_id');

            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('email_verified_at')->nullable();

            $table->foreign('rol_id')->references('id')->on('rols');
            $table->foreign('estado_id')->references('id')->on('estados');
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
        Schema::dropIfExists('users');
    }
}
