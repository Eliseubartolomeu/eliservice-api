<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role; 
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrador',
                'description' => 'Acesso total à plataforma, incluindo configurações do sistema e gestão de todos os utilizadores e conteúdos.'
            ],
            [
                'name' => 'cliente',
                'display_name' => 'Cliente',
                'description' => 'Utilizador final da plataforma, com acesso à consulta e agendamento de serviços.'
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role['name']],
                array_merge($role, ['id' => (string) Str::uuid()])
            );
        }
    }
}
