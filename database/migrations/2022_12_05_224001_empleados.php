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
        //
        Schema::create('empleados', function (Blueprint $table) {
            
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('dni');
            $table->integer('telefono');
            $table->string('domicilio');
            $table->string('email');
            $table->string('cargos');
            $table->bigInteger('id_sucursales_empleados')->unsigned();
            
            $table->timestamps();

            $table->foreign('id_sucursales_empleados')->references('id')->on('sucursales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
