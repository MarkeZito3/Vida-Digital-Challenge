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
        Schema::create('sucursales', function (Blueprint $table) {
            
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->string('direccion');
            $table->string('localidad');
            $table->string('telefono');
            $table->bigInteger('id_empresa_sucursales')->unsigned();
            
            $table->timestamps();

            $table->foreign('id_empresa_sucursales')->references('id')->on('empresas')->onDelete('cascade');
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
