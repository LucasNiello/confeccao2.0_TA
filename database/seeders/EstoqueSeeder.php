<?php

namespace Database\Seeders;

use App\Models\Estoque;
use App\Models\Produto;
use Illuminate\Database\Seeder;

class EstoqueSeeder extends Seeder
{
    public function run(): void
    {
        $quantidades = [50, 30, 45, 3, 100, 25, 40, 8, 60, 15, 20, 35, 2, 10, 55];
        $minimas     = [10, 10, 10,  5,  20,  5, 10,  5, 10,  5, 10, 10,  5,  5, 10];

        $produtos = Produto::all()->values();
        foreach ($produtos as $idx => $produto) {
            Estoque::create([
                'produto_id'       => $produto->id,
                'quantidade'       => $quantidades[$idx] ?? 20,
                'quantidade_minima'=> $minimas[$idx] ?? 5,
            ]);
        }
    }
}
