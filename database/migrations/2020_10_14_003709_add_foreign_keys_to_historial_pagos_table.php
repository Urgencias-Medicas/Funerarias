<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToHistorialPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historial_pagos', function (Blueprint $table) {
            $table->foreign('caso', 'historial_pagos_ibfk_1')->references('id')->on('casos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historial_pagos', function (Blueprint $table) {
            $table->dropForeign('historial_pagos_ibfk_1');
        });
    }
}
