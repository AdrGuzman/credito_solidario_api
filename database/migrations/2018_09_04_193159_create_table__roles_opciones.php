<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRolesOpciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_opciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('opcion_id');
            $table->integer('rol_id');
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
        Schema::dropIfExists('roles_opciones');
    }
}
