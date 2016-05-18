<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('password');
            $table->integer('tipo_usuario_id')->nullable()->unsigned();
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('usuarios', function(Blueprint $table){
            $table->foreign('tipo_usuario_id')->references('id')->on('tipo_usuarios');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuarios');
    }
}
