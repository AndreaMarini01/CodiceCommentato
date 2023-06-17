<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promozione', function (Blueprint $table) {
            $table->bigIncrements('idPromozione');
            $table->bigInteger('idAzienda');
            $table->string('oggetto');
            $table->string('modalità');
            $table->integer('scontistica');
            $table->string('luogoFruizione');
            $table->date('dataScadenza');
            $table->string('nomePromozione');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_coupons');
    }
};
