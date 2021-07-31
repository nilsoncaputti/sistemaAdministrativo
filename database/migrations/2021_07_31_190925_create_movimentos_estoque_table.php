<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentosEstoqueTable extends Migration
{
    public function up()
    {
        Schema::create('movimentos_estoque', function (Blueprint $table) {
            $table->id();

            $table->char('tipo', 7);

            $table->decimal('quantidade', 10, 2);
            $table->decimal('valor', 10, 2);

            $table->integer('produto_id')->unsigned();
            $table->foreign('produto_id')->references('id')->on('produtos');

            $table->bigInteger('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movimentos_estoque');
    }
}
