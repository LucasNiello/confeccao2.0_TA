<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    public function run(): void
    {
        $cargos = [
            ['nome' => 'Costureira',          'descricao' => 'Responsável pela costura de peças.',              'salario_base' => 1800.00],
            ['nome' => 'Modelista',            'descricao' => 'Cria os moldes das peças de confecção.',          'salario_base' => 2500.00],
            ['nome' => 'Cortador',             'descricao' => 'Realiza o corte dos tecidos conforme o molde.',   'salario_base' => 1900.00],
            ['nome' => 'Auxiliar de Produção', 'descricao' => 'Auxilia nas etapas de produção.',                 'salario_base' => 1400.00],
            ['nome' => 'Gerente de Produção',  'descricao' => 'Supervisiona e coordena o processo produtivo.',   'salario_base' => 4000.00],
        ];

        foreach ($cargos as $cargo) {
            Cargo::create($cargo);
        }
    }
}
