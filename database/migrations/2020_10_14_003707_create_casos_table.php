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
            $table->integer('id', true);
            $table->integer('Codigo')->nullable();
            $table->text('Nombre')->nullable();
            $table->date('Fecha')->nullable();
            $table->time('Hora')->nullable();
            $table->text('Causa')->nullable();
            $table->text('Direccion')->nullable();
            $table->text('Departamento')->nullable();
            $table->text('Municipio')->nullable();
            $table->text('Padre')->nullable();
            $table->text('TelPadre')->nullable();
            $table->text('Madre')->nullable();
            $table->text('TelMadre')->nullable();
            $table->text('NombreReporta')->nullable();
            $table->text('RelacionReporta')->nullable();
            $table->text('TelReporta')->nullable();
            $table->text('Lugar')->nullable();
            $table->integer('Funeraria')->nullable();
            $table->text('Estatus')->nullable();
            $table->text('Reportar')->nullable();
            $table->integer('Costo')->nullable();
            $table->integer('Pagado')->nullable();
            $table->integer('Pendiente')->nullable();
            $table->text('Solicitud')->nullable();
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
