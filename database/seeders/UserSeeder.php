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
        $users = [
            [
                'name' => 'Admin Geral',
                'photo' => null,
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'role_id' => '52d03998-dbb0-46d6-a428-9fa38ec84216',
            ],
            [
                'name' => 'João Cliente',
                'photo' => null,
                'username' => 'joaocliente',
                'email' => 'joao@example.com',
                'password' => Hash::make('cliente123'),
                'role_id' => '1c58e509-f820-4828-90e4-1c513ea83dac',
            ],
            [
                'name' => 'Maria da Silva',
                'photo' => null,
                'username' => 'mariasilva',
                'email' => 'maria@example.com',
                'password' => Hash::make('cliente123'),
                'role_id' => '1c58e509-f820-4828-90e4-1c513ea83dac',
            ],
            [
                'name' => 'Carlos Oliveira',
                'username' => 'carlosoliveira',
                'email' => 'carlos@example.com',
                'password' => Hash::make('cliente123'),
                'role_id' => '1c58e509-f820-4828-90e4-1c513ea83dac',
            ],
            [
                'name' => 'Ana Paula',
                'photo' => null,
                'username' => 'anapaula',
                'email' => 'ana@example.com',
                'password' => Hash::make('cliente123'),
                'role_id' => '1c58e509-f820-4828-90e4-1c513ea83dac',
            ],
            [
                'name' => 'Lucas Martins',
                'photo' => null,
                'username' => 'lucasm',
                'email' => 'lucas@example.com',
                'password' => Hash::make('cliente123'),
                'role_id' => '1c58e509-f820-4828-90e4-1c513ea83dac',
            ],
        ];

        foreach ($users as $user) {
            // User::create(array_merge($user, [
            //     'id' => (string) Str::uuid(), 
            // ]));
            User::updateOrCreate(array_merge($user, [
                'id' => (string) Str::uuid(), 
            ]));
        }
    }
}
