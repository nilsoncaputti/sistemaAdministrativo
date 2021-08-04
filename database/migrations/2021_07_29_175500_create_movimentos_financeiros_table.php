<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimentosFinanceirosTable extends Migration
{
    public function up()
    {
        Schema::create('movimentos_financeiros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao');
            $table->decimal('valor', 10, 2);
            $table->date('data');
            $table->string('tipo');

            $table->bigInteger('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('movimentos_financeiros');
    }
}
