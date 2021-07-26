<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empresa extends Model
{
    use SoftDeletes;

    protected $fillable = ['tipo', 'nome', 'razao_social', 'documento', 'ie_rg', 'nome_contato', 'celular', 'email', 'telefone', 'cep', 'logradouro', 'bairro', 'cidade', 'estado', 'observacao'];

    //Retorna empresas por tipo
    public static function todasPorTipo(string $tipo, int $quantidade = 5): AbstractPaginator
    {
        return self::where('tipo', $tipo)->paginate($quantidade);
    }

    //use HasFactory;
}
