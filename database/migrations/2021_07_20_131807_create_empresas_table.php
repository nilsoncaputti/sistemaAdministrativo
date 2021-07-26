<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();

            $table->char('tipo', 10);

            $table->string('nome');
            $table->string('razao_social')->nullable();
            $table->char('documento', 18);
            $table->char('ie_rg', 25)->nullable();

            $table->string('nome_contato', 255);
            $table->char('celular', 25);
            $table->string('email', 100);
            $table->char('telefone', 25)->nullable();

            $table->char('cep', 9);
            $table->string('logradouro', 150);
            $table->string('bairro', 100);
            $table->string('cidade', 100);
            $table->char('estado', 2);

            $table->text('observacao', 500)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
