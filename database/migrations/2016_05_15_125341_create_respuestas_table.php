<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->nullable()->unsigned();
            $table->integer('pregunta_id')->nullable()->unsigned();
            $table->boolean('correcta');
            $table->string('respuesta', 1000);
            $table->timestamps();
        });
        Schema::table('respuestas', function(Blueprint $table){
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('pregunta_id')->references('id')->on('preguntas');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('respuestas');
    }
}
