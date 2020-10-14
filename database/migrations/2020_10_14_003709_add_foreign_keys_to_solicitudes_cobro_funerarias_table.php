<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSolicitudesCobroFunerariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitudes_cobro_funerarias', function (Blueprint $table) {
            $table->foreign('caso', 'solicitudes_cobro_funerarias_ibfk_1')->references('id')->on('casos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitudes_cobro_funerarias', function (Blueprint $table) {
            $table->dropForeign('solicitudes_cobro_funerarias_ibfk_1');
        });
    }
}
