<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutorizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autorizaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rol_id');
            $table->integer('sistema_id');
            $table->integer('modulo_id');
            $table->integer('opcion_id');
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
        Schema::dropIfExists('autorizaciones');
    }
}
