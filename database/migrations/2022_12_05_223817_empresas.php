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
        Schema::create('empresas', function (Blueprint $table) {
            
            $table->engine="InnoDB"; //este engine me permitirá borrar las cosas en cascada, ya que si no hay empresa, tampoco hay sucursales de las mismas y mucho menos empleados

            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('logo'); // en logo iría una foto del logo de la empresa.
            
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
        //
    }
};
