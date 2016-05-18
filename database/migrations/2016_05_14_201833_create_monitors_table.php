<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->nullable()->unsigned();
            $table->integer('asignatura_id')->nullable()->unsigned();
            $table->timestamps();
        });
        Schema::table('monitors', function(Blueprint $table){
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
        Schema::drop('monitors');
    }
}
