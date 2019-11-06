<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('convention_id');
            $table->integer('salon_id')->nullable();
            $table->integer('tamano_reunion');
            $table->integer('user_id');
            $table->integer('user_encargado_id');
            $table->integer('ministry_id');
            $table->integer('costo_evento');
            $table->integer('reuniontype_id');
            $table->text('proposito');
            $table->integer('fecha_reunion');
            $table->integer('hora_inicio');
            $table->integer('hora_fin');
            $table->integer('fecha_solicitud');
            $table->integer('hora_solicitud');
            $table->integer('estado');
            $table->integer('cantidad_persona');
            $table->integer('montaje_id');
            $table->integer('manteleria_id')->nullable();
            $table->integer('musical_id')->nullable();
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('reserves');
    }
}
