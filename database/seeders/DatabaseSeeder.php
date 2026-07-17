<?php

namespace Database\Seeders;

use App\Enums\CreatureType;
use App\Models\Creature;
use App\Models\Effect;
use App\Models\MainList;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        $effects = [
            [
                'name'  => 'Ярость',
                'color' => 'red-600'
            ],
            [
                'name'  => 'Божественная кара',
                'color' => 'yellow-400'
            ],
            [
                'name'  => 'Кровотечение',
                'color' => 'rose-600'
            ],
            [
                'name'  => 'Уклонение',
                'color' => 'cyan-400'
            ],
            [
                'name'  => 'Испуг',
                'color' => 'purple-500'
            ],
            [
                'name'  => 'Без сознания',
                'color' => 'gray-500'
            ],
            [
                'name'  => 'Невидимость',
                'color' => 'white/30'
            ],
            [
                'name'  => 'Недееспособность',
                'color' => 'stone-500'
            ],
            [
                'name'  => 'Глухота',
                'color' => 'slate-400'
            ],
            [
                'name'  => 'Окаменение',
                'color' => 'stone-300'
            ],
            [
                'name'  => 'Опутан',
                'color' => 'green-600'
            ],
            [
                'name'  => 'Слепота',
                'color' => 'zinc-400'
            ],
            [
                'name'  => 'Отравление',
                'color' => 'green-500'
            ],
            [
                'name'  => 'Очарование',
                'color' => 'pink-400'
            ],
            [
                'name'  => 'Ошеломление',
                'color' => 'orange-500'
            ],
            [
                'name'  => 'Паралич',
                'color' => 'yellow-200'
            ],
            [
                'name'  => 'Сбит с ног',
                'color' => 'orange-300'
            ],
            [
                'name'  => 'Схвачен',
                'color' => 'purple-600'
            ],
        ];

        foreach ($effects as $effectKey => $effect) {
            Effect::create($effect);
        }

        $creatures = [
            [
                'name'       => 'Веледара',
                'type'       => CreatureType::PLAYABLE,
                'initiative' => 30,
            ],
            [
                'name'       => 'Доброслав',
                'type'       => CreatureType::PLAYABLE,
                'initiative' => 31,
            ],
            [
                'name'       => 'Симба',
                'type'       => CreatureType::PLAYABLE,
                'initiative' => rand(1, 23),
            ],
        ];

        foreach ($creatures as $creatureKey => $creature) {
            $cr = Creature::create($creature);

            if ($creatureKey === 0) {
                // $cr->effects()->attach(range(1, count($effects)));
            }
        }

        Creature::factory(3)->create();

        MainList::create();


    }
}
