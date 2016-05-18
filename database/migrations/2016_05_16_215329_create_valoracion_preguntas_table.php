<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValoracionPreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valoracion_preguntas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pregunta_id')->nullable()->unsigned();
            $table->integer('usuario_id')->nullable()->unsigned();
            $table->integer('valoracion')->default(0);
            $table->timestamps();
        });
        Schema::table('valoracion_preguntas', function(Blueprint $table){
            $table->foreign('pregunta_id')->references('id')->on('preguntas');
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
        Schema::drop('valoracion_preguntas');
    }
}
