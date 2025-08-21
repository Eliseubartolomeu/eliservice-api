<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{User,Role};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $clienteRole = Role::where('name', 'cliente')->first();

        $clientPass = Hash::make('cliente123');

        $users = [
            [
                'name' => 'Admin Geral',
                'photo' => null,
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'role_id' => $adminRole->id,
            ],
            [
                'name' => 'Pedro Developer',
                'photo' => null,
                'username' => 'pedrodev',
                'email' => 'pedrodev@example.com',
                'password' => Hash::make('admin123'),
                'role_id' => $adminRole->id,
            ],
            [
                'name' => 'Feliciana Miguel',
                'photo' => null,
                'username' => 'felicianamiguel',
                'email' => 'feliciana@example.com',
                'password' => Hash::make('admin123'),
                'role_id' => $adminRole->id,
            ],
            [
                'name' => 'João Cliente',
                'photo' => null,
                'username' => 'joaocliente',
                'email' => 'joao@example.com',
                'password' => $clientPass,
                'role_id' => $clienteRole->id,
            ],
            [
                'name' => 'Maria da Silva',
                'photo' => null,
                'username' => 'mariasilva',
                'email' => 'maria@example.com',
                'password' => $clientPass,
                'role_id' => $clienteRole->id,
            ],
            [
                'name' => 'Carlos Oliveira',
                'username' => 'carlosoliveira',
                'email' => 'carlos@example.com',
                'password' => $clientPass,
                'role_id' => $clienteRole->id,
            ],
            [
                'name' => 'Ana Paula',
                'photo' => null,
                'username' => 'anapaula',
                'email' => 'ana@example.com',
                'password' => $clientPass,
                'role_id' => $clienteRole->id,
            ],
            [
                'name' => 'Lucas Martins',
                'photo' => null,
                'username' => 'lucasm',
                'email' => 'lucas@example.com',
                'password' => $clientPass,
                'role_id' => $clienteRole->id,
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => $user['email']], 
                array_merge($user, ['id' => (string) Str::uuid()])
            );
        }
    }
}
