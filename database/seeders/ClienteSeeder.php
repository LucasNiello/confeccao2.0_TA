<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            ['nome' => 'Boutique Elegance Ltda',       'cpf_cnpj' => '12.345.678/0001-90', 'email' => 'compras@elegance.com.br',    'telefone' => '(11) 3456-7890', 'endereco' => 'Rua da Moda, 100, São Paulo - SP'],
            ['nome' => 'Loja Estilo Fashion',           'cpf_cnpj' => '23.456.789/0001-01', 'email' => 'contato@estilopashoion.com', 'telefone' => '(11) 4567-8901', 'endereco' => 'Av. Paulista, 500, São Paulo - SP'],
            ['nome' => 'Confecções Premium ME',         'cpf_cnpj' => '34.567.890/0001-12', 'email' => 'compras@premium.com.br',     'telefone' => '(19) 3234-5678', 'endereco' => 'Rua do Comércio, 200, Campinas - SP'],
            ['nome' => 'Marina Ramos Vasconcelos',      'cpf_cnpj' => '456.789.012-45',     'email' => 'marina.rv@gmail.com',        'telefone' => '(19) 98888-1234', 'endereco' => 'Rua das Flores, 88, Limeira - SP'],
            ['nome' => 'Atacado Moda Norte',            'cpf_cnpj' => '56.789.012/0001-23', 'email' => 'pedidos@modanorte.com.br',   'telefone' => '(92) 3345-6789', 'endereco' => 'Av. Eduardo Ribeiro, 1000, Manaus - AM'],
            ['nome' => 'Giulia Bianchi Modas',          'cpf_cnpj' => '67.890.123/0001-34', 'email' => 'giulia@bianchimodas.com.br', 'telefone' => '(11) 5678-9012', 'endereco' => 'Rua Augusta, 300, São Paulo - SP'],
            ['nome' => 'Thiago Mendes',                 'cpf_cnpj' => '789.012.345-67',     'email' => 'thiago.mendes@hotmail.com',  'telefone' => '(19) 97777-9876', 'endereco' => 'Rua Sete de Setembro, 55, Piracicaba - SP'],
            ['nome' => 'Style For You',                 'cpf_cnpj' => '89.012.345/0001-56', 'email' => 'compras@styleforyou.com',   'telefone' => '(21) 2223-4567', 'endereco' => 'Rua Visconde de Pirajá, 400, Rio de Janeiro - RJ'],
            ['nome' => 'Tatiana Alves Costura',         'cpf_cnpj' => '901.234.567-89',     'email' => 'tatiana.costura@gmail.com',  'telefone' => '(19) 96666-5432', 'endereco' => 'Rua XV de Novembro, 77, Limeira - SP'],
            ['nome' => 'Ateliê Moda & Arte Ltda',      'cpf_cnpj' => '01.234.567/0001-78', 'email' => 'atelie@modaarte.com.br',     'telefone' => '(19) 3322-1100', 'endereco' => 'Av. Independência, 600, Limeira - SP'],
        ];

        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }
    }
}
