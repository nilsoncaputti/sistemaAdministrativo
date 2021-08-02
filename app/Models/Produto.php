<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;

    protected $table = 'produtos';

    protected $primaryKey = 'id';

    protected $fillable = ['nome', 'descricao'];

    //Define dados para serialização
    protected $visible = ['id', 'text'];

    //Anexa acessores a serialização
    protected $appends = ['text'];

    //Busca produto por nome
    public static function buscarPorNome(string $nome)
    {
        $nome = '%' . $nome . '%';

        return self::where('nome', 'LIKE', $nome)->get();
    }

    //Cria acessor chamado text para serialização 
    public function getTextAttribute(): string
    {
        return $this->attributes['nome'];
    }
}
