<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsuarioSeeder::class,
            CargoSeeder::class,
            FuncionarioSeeder::class,
            ClienteSeeder::class,
            FornecedorSeeder::class,
            CategoriaSeeder::class,
            ProdutoSeeder::class,
            EstoqueSeeder::class,
            PedidoSeeder::class,
        ]);
    }
}
