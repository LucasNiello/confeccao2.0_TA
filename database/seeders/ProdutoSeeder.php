<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        $produtos = [
            // Categoria 1 - Camisas e Blusas
            ['categoria_id' => 1, 'fornecedor_id' => 1, 'nome' => 'Camisa Social Masculina Slim', 'descricao' => 'Camisa social slim fit algodão', 'preco_custo' => 35.00, 'preco_venda' => 89.90],
            ['categoria_id' => 1, 'fornecedor_id' => 1, 'nome' => 'Blusa Feminina Estampada',     'descricao' => 'Blusa feminina com estampa floral', 'preco_custo' => 22.00, 'preco_venda' => 59.90],
            ['categoria_id' => 1, 'fornecedor_id' => 5, 'nome' => 'Camisa Polo Masculina',        'descricao' => 'Camisa polo 100% algodão',          'preco_custo' => 28.00, 'preco_venda' => 75.00],
            ['categoria_id' => 1, 'fornecedor_id' => 1, 'nome' => 'Blusa de Frio Feminina',       'descricao' => 'Blusa de frio tricot',              'preco_custo' => 45.00, 'preco_venda' => 120.00],
            ['categoria_id' => 1, 'fornecedor_id' => 5, 'nome' => 'Camiseta Básica Unissex',      'descricao' => 'Camiseta algodão penteado',         'preco_custo' => 15.00, 'preco_venda' => 39.90],

            // Categoria 2 - Calças e Shorts
            ['categoria_id' => 2, 'fornecedor_id' => 1, 'nome' => 'Calça Jeans Masculina',        'descricao' => 'Calça jeans slim masculina',        'preco_custo' => 55.00, 'preco_venda' => 149.90],
            ['categoria_id' => 2, 'fornecedor_id' => 2, 'nome' => 'Calça Social Feminina',        'descricao' => 'Calça social alfaiataria',          'preco_custo' => 48.00, 'preco_venda' => 129.90],
            ['categoria_id' => 2, 'fornecedor_id' => 1, 'nome' => 'Bermuda Masculina',            'descricao' => 'Bermuda tecido linho',              'preco_custo' => 30.00, 'preco_venda' => 79.90],
            ['categoria_id' => 2, 'fornecedor_id' => 2, 'nome' => 'Short Feminino',              'descricao' => 'Short jeans feminino rasgado',      'preco_custo' => 25.00, 'preco_venda' => 65.00],
            ['categoria_id' => 2, 'fornecedor_id' => 1, 'nome' => 'Legging Feminina',             'descricao' => 'Legging suplex dry fit',            'preco_custo' => 20.00, 'preco_venda' => 54.90],

            // Categoria 3 - Vestidos e Saias
            ['categoria_id' => 3, 'fornecedor_id' => 5, 'nome' => 'Vestido Floral Longo',        'descricao' => 'Vestido longo com estampa floral',  'preco_custo' => 65.00, 'preco_venda' => 179.90],
            ['categoria_id' => 3, 'fornecedor_id' => 1, 'nome' => 'Vestido Tubinho Executiva',    'descricao' => 'Vestido tubinho para escritório',   'preco_custo' => 70.00, 'preco_venda' => 199.90],
            ['categoria_id' => 3, 'fornecedor_id' => 5, 'nome' => 'Saia Midi Plissada',           'descricao' => 'Saia midi plissada com bolso',      'preco_custo' => 38.00, 'preco_venda' => 99.90],
            ['categoria_id' => 3, 'fornecedor_id' => 1, 'nome' => 'Vestido Festa Longo',          'descricao' => 'Vestido de festa em cetim',         'preco_custo' => 110.00, 'preco_venda' => 320.00],
            ['categoria_id' => 3, 'fornecedor_id' => 2, 'nome' => 'Saia Jeans Mini',              'descricao' => 'Saia jeans com cinto',              'preco_custo' => 28.00, 'preco_venda' => 74.90],
        ];

        foreach ($produtos as $produto) {
            Produto::create($produto);
        }
    }
}
