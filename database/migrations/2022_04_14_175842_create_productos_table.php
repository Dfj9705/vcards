<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->decimal('precio');
            $table->foreignId('tipo_id')->references('id')->on('tipo_productos')->comment('Tipo de producto');
            $table->timestamps();
        });

        Schema::create('producto_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->references('id')->on('productos')->comment('Id de producto');
            $table->string('imagen');
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
        Schema::dropIfExists('tipos_productos');
        Schema::dropIfExists('productos');
        Schema::dropIfExists('foto_productos');
    }
}
