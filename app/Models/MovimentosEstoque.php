<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentosEstoque extends Model
{
    //Define o nome da tabela
    protected $table = 'movimentos_estoque';

    //Define a relação com produto
    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }
}
