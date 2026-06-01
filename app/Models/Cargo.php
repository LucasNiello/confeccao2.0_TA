<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'salario_base',
    ];

    protected function casts(): array
    {
        return [
            'salario_base' => 'decimal:2',
        ];
    }

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class);
    }
}
