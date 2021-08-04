<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentosEstoque extends Model
{
    //Define o nome da tabela
    protected $table = 'movimentos_estoque';

    //Campos permitidos em definição de dados em massa
    protected $fillable = ['produto_id', 'quantidade', 'valor', 'tipo', 'empresa_id'];

    //Define a relação com produto
    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }

    //Configura a relação com o histórico do saldo
    public function saldo()
    {
        return $this->MorphOne('App\Models\Saldo', 'movimento');
    }
}
