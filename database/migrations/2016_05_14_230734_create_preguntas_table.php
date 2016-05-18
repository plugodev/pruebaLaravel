<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pregunta', 1000);
            $table->integer('asignatura_id')->nullable()->unsigned();
            $table->integer('usuario_id')->nullable()->unsigned();
            $table->timestamps();
        });
        Schema::table('preguntas', function(Blueprint $table){
            $table->foreign('asignatura_id')->references('id')->on('asignaturas');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('preguntas');
    }
}
