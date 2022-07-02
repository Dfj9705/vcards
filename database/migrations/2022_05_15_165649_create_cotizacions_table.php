<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->references('id')->on('productos')->comment('Id de producto');
            $table->foreignId('user_id')->references('id')->on('users')->comment('Usuario que cotiza');
            $table->dateTime('fecha')->comment('fecha de la cotización');
            $table->integer('cantidad')->comment('cantidad de productos');
            $table->smallInteger('status')->default(1)->comment('estado de la cotizacion');
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
        Schema::dropIfExists('cotizaciones');
    }
}
