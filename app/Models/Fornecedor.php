<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedores';

    protected $fillable = [
        'razao_social',
        'cnpj',
        'email',
        'telefone',
        'tipo_material',
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
