<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sistema_id');
            $table->integer('modulo_id');
            $table->string('nombre', 45);
            $table->integer('estado');
            $table->integer('creado_por');
            $table->integer('actualizado_por');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opciones');
    }
}
