<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->text('descripcion');
			$table->integer('estado');
			$table->boolean('accCentConv')->default(false);
            $table->boolean('accSalones')->default(false);
            $table->boolean('accTipoReunion')->default(false);
            $table->boolean('accRecurso')->default(false);
            $table->boolean('accRol')->default(false);
            $table->boolean('accUsuario')->default(false);
            $table->boolean('opcReserva')->default(false);
            $table->boolean('opcAprobar')->default(false);
			$table->boolean('opcSolicitar')->default(false);
			$table->boolean('visEvenPriv')->default(false);
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
        Schema::dropIfExists('roles');
    }
}
