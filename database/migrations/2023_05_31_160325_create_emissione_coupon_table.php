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
        Schema::create('emissione_coupon', function (Blueprint $table) {
            $table->string('idPromozione');
            $table->string('idUtente');
            $table->date('dataEmissione');
            $table->string('codice')->unique();
            $table->primary(['idPromozione', 'idUtente']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emissione_coupon');
    }
};
