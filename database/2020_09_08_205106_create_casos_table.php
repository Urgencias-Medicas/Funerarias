<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casos', function (Blueprint $table) {
            $table->id();
            $table->integer('Codigo');
            $table->string('Nombre');
            $table->date('Fecha');
            $table->time('Hora');
            $table->string('Causa');
            $table->string('Direccion');
            $table->string('Departamento');
            $table->string('Municipio');
            $table->string('Padre');
            $table->string('Madre');
            $table->string('Lugar');
            $table->integer('Funeraria');
            $table->string('Estatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('casos');
    }
}
