<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            // Beleza e bem-estar
            [
                'name' => 'Corte de Cabelo Masculino',
                'description' => 'Corte clássico ou moderno para homens.',
                'duration' => 30,
                'price' => 40.00
            ],
            [
                'name' => 'Manicure',
                'description' => 'Serviço completo de manicure.',
                'duration' => 30,
                'price' => 30.00
            ],
            // Saúde
            [
                'name' => 'Consulta Médica',
                'description' => 'Consulta com médico clínico geral.',
                'duration' => 45,
                'price' => 150.00
            ],
            [
                'name' => 'Sessão de Fisioterapia',
                'description' => 'Tratamento fisioterapêutico personalizado.',
                'duration' => 60,
                'price' => 120.00
            ],
            // Educação
            [
                'name' => 'Aula de Inglês Particular',
                'description' => 'Aula individual para melhorar o inglês.',
                'duration' => 60,
                'price' => 100.00
            ],
            [
                'name' => 'Curso de Programação',
                'description' => 'Curso introdutório de programação em Python.',
                'duration' => 120,
                'price' => 250.00
            ],
            // Tecnologia
            [
                'name' => 'Reparo de Computador',
                'description' => 'Serviço técnico para manutenção de computadores.',
                'duration' => 90,
                'price' => 180.00
            ],
            [
                'name' => 'Configuração de Rede Wi-Fi',
                'description' => 'Setup e otimização da rede Wi-Fi residencial.',
                'duration' => 60,
                'price' => 120.00
            ],
            // Lazer e entretenimento
            [
                'name' => 'Aula de Yoga',
                'description' => 'Sessão de yoga para relaxamento e flexibilidade.',
                'duration' => 60,
                'price' => 80.00
            ],
            [
                'name' => 'Sessão de Fotografia',
                'description' => 'Ensaio fotográfico profissional.',
                'duration' => 90,
                'price' => 300.00
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(array_merge($service, [
                'id' => (string) Str::uuid(),
            ]));
        }

    }
}
