<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesCobroFunerariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes_cobro_funerarias', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('caso')->index('caso');
            $table->text('estatus')->nullable();
            $table->integer('costo')->nullable();
            $table->text('descripcion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudes_cobro_funerarias');
    }
}
