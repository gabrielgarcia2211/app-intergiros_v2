<?php

namespace Database\Seeders\Solicitudes;

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Models\Solicitudes\Producto;

class ProductSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        // Define los rangos de costos
        $costRanges = [
            [0, 100], [101, 200], [201, 300], [301, 400], [401, 500],
            [501, 600], [601, 700], [701, 800], [801, 900], [901, 1000]
        ];

        for ($i = 0; $i < 1000; $i++) {
            // Elige un rango de costo aleatoriamente
            $selectedRange = $faker->randomElement($costRanges);
            $cost = $faker->numberBetween($selectedRange[0], $selectedRange[1]);

            Producto::create([
                'nombre' => $faker->words(3, true),
                'descripcion' => $faker->sentence(6),
                'servicio' => $faker->randomElement(['Servicio A', 'Servicio B', 'Servicio C']),
                'costo' => $cost
            ]);
        }
    }
}
