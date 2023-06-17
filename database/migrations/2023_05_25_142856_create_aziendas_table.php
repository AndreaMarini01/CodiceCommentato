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
        Schema::create('aziendas', function (Blueprint $table) {
            $table->string('ragioneSociale');
            $table->text('localizzazione');
            $table->text('nomeAzienda');
            $table->string('logo');
            $table->text('tipologia');
            $table->longText('descrizioneAzienda');
            $table->bigIncrements('idAzienda');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aziendas');
    }
};
