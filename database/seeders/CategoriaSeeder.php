<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nome' => 'Camisas e Blusas',  'descricao' => 'Camisas sociais, blusas femininas e masculinas.'],
            ['nome' => 'Calças e Shorts',    'descricao' => 'Calças jeans, sociais, bermudas e shorts.'],
            ['nome' => 'Vestidos e Saias',   'descricao' => 'Vestidos de festa, casuais, saias longas e curtas.'],
        ];

        foreach ($categorias as $cat) {
            Categoria::create($cat);
        }
    }
}
