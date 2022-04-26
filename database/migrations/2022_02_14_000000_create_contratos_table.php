<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_imovel');
            $table->string('cep');
            $table->string('rua')->nullable();;
            $table->string('numero')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('bairro')->nullable();
            $table->string('status')->nullable();
            $table->string('complemento')->nullable();
            $table->decimal('valor_locaticio', 10,2)->nullable();
            $table->decimal('valor_plano', 10,2)->nullable();
            $table->integer('tempo')->nullable();
            $table->unsignedBigInteger('id_plano')->unsigned();
            $table->unsignedBigInteger('id_taxa')->unsigned();
            $table->unsignedBigInteger('id_cliente')->unsigned();
            $table->unsignedBigInteger('id_user')->unsigned();
            $table->date('data_pagamento')->nullable();
            $table->timestamps();

            $table->foreign('id_plano')->references('id')->on('planos');
            $table->foreign('id_taxa')->references('id')->on('taxas');
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
