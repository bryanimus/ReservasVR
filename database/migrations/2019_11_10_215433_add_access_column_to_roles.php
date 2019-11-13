<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccessColumnToRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->boolean('accCentConv')->default(false);
            $table->boolean('accMinisterio')->default(false);
            $table->boolean('accSalones')->default(false);
            $table->boolean('accTipoReunion')->default(false);
            $table->boolean('accRecurso')->default(false);
            $table->boolean('accRol')->default(false);
            $table->boolean('accUsuario')->default(false);
            $table->boolean('opcReserva')->default(false);
            $table->boolean('opcAprobar')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            //
        });
    }
}
