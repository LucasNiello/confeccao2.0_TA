<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administrador',
            'email'    => 'admin@confeccao.com',
            'password' => Hash::make('password'),
            'perfil'   => 'admin',
            'ativo'    => true,
        ]);

        $funcionarios = [
            ['name' => 'Ana Paula Ferreira', 'email' => 'ana.ferreira@confeccao.com'],
            ['name' => 'Carlos Eduardo Lima', 'email' => 'carlos.lima@confeccao.com'],
            ['name' => 'Mariana Santos', 'email' => 'mariana.santos@confeccao.com'],
            ['name' => 'Ricardo Oliveira', 'email' => 'ricardo.oliveira@confeccao.com'],
            ['name' => 'Fernanda Costa', 'email' => 'fernanda.costa@confeccao.com'],
        ];

        foreach ($funcionarios as $f) {
            User::create([
                'name'     => $f['name'],
                'email'    => $f['email'],
                'password' => Hash::make('password'),
                'perfil'   => 'funcionario',
                'ativo'    => true,
            ]);
        }
    }
}
