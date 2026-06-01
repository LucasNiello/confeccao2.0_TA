<?php

namespace Database\Seeders;

use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Database\Seeder;

class FuncionarioSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = User::where('perfil', 'funcionario')->get();

        $dados = [
            ['cpf' => '123.456.789-01', 'telefone' => '(19) 99101-1111', 'data_admissao' => '2023-01-10', 'cargo_id' => 1],
            ['cpf' => '234.567.890-12', 'telefone' => '(19) 99202-2222', 'data_admissao' => '2023-03-15', 'cargo_id' => 2],
            ['cpf' => '345.678.901-23', 'telefone' => '(19) 99303-3333', 'data_admissao' => '2022-08-01', 'cargo_id' => 3],
            ['cpf' => '456.789.012-34', 'telefone' => '(19) 99404-4444', 'data_admissao' => '2024-02-20', 'cargo_id' => 4],
            ['cpf' => '567.890.123-45', 'telefone' => '(19) 99505-5555', 'data_admissao' => '2021-05-12', 'cargo_id' => 5],
        ];

        foreach ($usuarios as $idx => $usuario) {
            if (!isset($dados[$idx])) break;
            Funcionario::create([
                'usuario_id'    => $usuario->id,
                'cargo_id'      => $dados[$idx]['cargo_id'],
                'cpf'           => $dados[$idx]['cpf'],
                'telefone'      => $dados[$idx]['telefone'],
                'data_admissao' => $dados[$idx]['data_admissao'],
                'status'        => 'ativo',
            ]);
        }
    }
}
