<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioAsignaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_asignaturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->nullable()->unsigned();
            $table->integer('asignatura_id')->nullable()->unsigned();
            $table->timestamps();
        });
        Schema::table('usuario_asignaturas', function(Blueprint $table){
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('asignatura_id')->references('id')->on('asignaturas');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuario_asignaturas');
    }
}
