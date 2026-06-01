<?php

namespace Database\Seeders;

use App\Models\Fornecedor;
use Illuminate\Database\Seeder;

class FornecedorSeeder extends Seeder
{
    public function run(): void
    {
        $fornecedores = [
            ['razao_social' => 'Tecidos & Aviamentos SP Ltda',  'cnpj' => '11.222.333/0001-44', 'email' => 'vendas@tecidossp.com.br',   'telefone' => '(11) 3333-4444', 'tipo_material' => 'tecidos'],
            ['razao_social' => 'Aviamentos do Brasil ME',        'cnpj' => '22.333.444/0001-55', 'email' => 'pedidos@aviamentos.com.br', 'telefone' => '(11) 4444-5555', 'tipo_material' => 'aviamentos'],
            ['razao_social' => 'Maquinaria Industrial Têxtil',   'cnpj' => '33.444.555/0001-66', 'email' => 'vendas@maquinaria.com.br',  'telefone' => '(19) 5555-6666', 'tipo_material' => 'maquinario'],
            ['razao_social' => 'Serviços de Bordado Premium',    'cnpj' => '44.555.666/0001-77', 'email' => 'contato@bordado.com.br',    'telefone' => '(19) 6666-7777', 'tipo_material' => 'servicos'],
            ['razao_social' => 'Tecidos Naturais & Orgânicos',   'cnpj' => '55.666.777/0001-88', 'email' => 'natural@tecidos.com.br',    'telefone' => '(11) 7777-8888', 'tipo_material' => 'tecidos'],
        ];

        foreach ($fornecedores as $fornecedor) {
            Fornecedor::create($fornecedor);
        }
    }
}
