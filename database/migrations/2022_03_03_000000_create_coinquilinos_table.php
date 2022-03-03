<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinquilinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coinquilinos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_contrato')->unsigned();
            $table->unsignedBigInteger('id_cliente')->unsigned();
            $table->timestamps();

            $table->foreign('id_contrato')->references('id')->on('contratos');
            $table->foreign('id_cliente')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coinquilinos');
    }
}
