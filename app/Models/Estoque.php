<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'estoques';

    protected $fillable = [
        'produto_id',
        'quantidade',
        'quantidade_minima',
    ];

    protected function casts(): array
    {
        return [
            'quantidade' => 'integer',
            'quantidade_minima' => 'integer',
        ];
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function estaBaixo(): bool
    {
        return $this->quantidade <= $this->quantidade_minima;
    }
}
