<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'cargo_id',
        'cpf',
        'telefone',
        'data_admissao',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'data_admissao' => 'date',
        ];
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
