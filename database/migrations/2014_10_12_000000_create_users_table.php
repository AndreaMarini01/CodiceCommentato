<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    //Esegue la migration
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telefono');
            $table->date('datadinascita');
            $table->string('username')->unique();
            $table->string('cognome');
            $table->string('genere');
            $table->string('role',10)->default('user');
        });


    }


    //Elimina la migration
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
