<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxas', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();;
            $table->decimal('valor', 6,2)->nullable();
            $table->decimal('comissao', 6,2)->nullable();
            $table->integer('parcelas')->unsigned();
            $table->integer('codigo_vindi')->unsigned();
            $table->integer('codigo_plano_vindi')->unsigned();
            $table->tinyInteger('ativo')->default(1);
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
        Schema::dropIfExists('taxas');
    }
}
