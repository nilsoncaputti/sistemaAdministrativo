<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tipo',
        'nome',
        'razao_social',
        'documento',
        'ie_rg',
        'nome_contato',
        'celular',
        'email',
        'telefone',
        'cep',
        'logradouro',
        'bairro',
        'cidade',
        'estado',
        'observacao'
    ];

    //Define dados para serialização
    protected $visible = ['id', 'text'];

    //Anexa acessores a serialização
    protected $appends = ['text'];

    public static function todasPorTipo(string $tipo, int $quantidade = 10): AbstractPaginator
    {
        return self::where('tipo', $tipo)->paginate($quantidade);
    }

    public static function buscarPorNomeTipo(string $nome, string $tipo)
    {
        $nome = '%' . $nome . '%';

        return self::where('nome', 'LIKE', $nome)
                        ->where('tipo', $tipo)
                        ->get();
    }
    
    //Cria acessor chamado Text para serialização
    public function getTextAttribute(): string
    {
        return \sprintf(
            '%s (%s)', 
            $this->attributes['nome'],
            $this->attributes['tipo']
        );
    }
}
