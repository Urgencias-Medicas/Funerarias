<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesFunerariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_funeraria', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('paso_uno')->nullable();
            $table->text('paso_dos')->nullable();
            $table->text('paso_tres')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_funeraria');
    }
}
