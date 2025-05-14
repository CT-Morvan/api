<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exercises = [
            // Peitoral
            [
                'name' => 'Supino Reto',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Supino Inclinado',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Supino Declinado',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Crucifixo',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Peck Deck',
                'video_url' => null,
                'image_url' => null,
            ],

            // Costas
            [
                'name' => 'Barra Fixa',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Puxada Alta',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Remada Baixa',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Remada Unilateral',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Pulldown',
                'video_url' => null,
                'image_url' => null,
            ],

            // Pernas
            [
                'name' => 'Agachamento Livre',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Leg Press',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Cadeira Extensora',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Cadeira Flexora',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Stiff',
                'video_url' => null,
                'image_url' => null,
            ],

            // Ombros
            [
                'name' => 'Desenvolvimento',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Elevação Lateral',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Elevação Frontal',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Remada Alta',
                'video_url' => null,
                'image_url' => null,
            ],

            // Bíceps
            [
                'name' => 'Rosca Direta',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Rosca Martelo',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Rosca Scott',
                'video_url' => null,
                'image_url' => null,
            ],

            // Tríceps
            [
                'name' => 'Tríceps Testa',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Tríceps Corda',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Tríceps Francês',
                'video_url' => null,
                'image_url' => null,
            ],

            // Abdômen
            [
                'name' => 'Abdominal Crunch',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Prancha',
                'video_url' => null,
                'image_url' => null,
            ],
            [
                'name' => 'Elevação de Pernas',
                'video_url' => null,
                'image_url' => null,
            ],
        ];

        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }
    }
}
