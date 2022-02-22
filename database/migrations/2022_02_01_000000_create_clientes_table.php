<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf');
            $table->string('telefone')->nullable();;
            $table->string('telefone_contato')->nullable();
            $table->string('telefone_referencia')->nullable();
            $table->string('nome_referencia')->nullable();
            $table->string('score')->nullable();
            $table->decimal('renda', 10,2)->nullable();
            $table->date('data_nasc')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('id_vindi')->unsigned();
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
        Schema::dropIfExists('clientes');
    }
}
