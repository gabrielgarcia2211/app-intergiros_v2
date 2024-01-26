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
            ['nombre' => 'Corrección de imagen', 'costoBase' => 5, 'rangoMin' => 5, 'rangoMax' => 19],
            ['nombre' => 'Banner o Flyer Web', 'costoBase' => 20, 'rangoMin' => 20, 'rangoMax' => 39],
            ['nombre' => 'Rediseño de Logotipo', 'costoBase' => 40, 'rangoMin' => 40, 'rangoMax' => 59],
            ['nombre' => 'Tarjetas de presentación', 'costoBase' => 60, 'rangoMin' => 60, 'rangoMax' => 79],
            ['nombre' => 'Animación de Logotipo', 'costoBase' => 80, 'rangoMin' => 80, 'rangoMax' => 99],
            ['nombre' => 'Creación de Logotipo', 'costoBase' => 100, 'rangoMin' => 100, 'rangoMax' => 119],
            ['nombre' => 'Diseño de Brochure', 'costoBase' => 120, 'rangoMin' => 120, 'rangoMax' => 139],
            ['nombre' => 'Ilustración', 'costoBase' => 140, 'rangoMin' => 140, 'rangoMax' => 159],
            ['nombre' => 'Hosting Básico', 'costoBase' => 160, 'rangoMin' => 160, 'rangoMax' => 179],
            ['nombre' => 'Hosting Profesional', 'costoBase' => 180, 'rangoMin' => 180, 'rangoMax' => 199],
            ['nombre' => 'Hosting Empresarial', 'costoBase' => 200, 'rangoMin' => 200, 'rangoMax' => 219],
            ['nombre' => 'Cloud Hosting Básico', 'costoBase' => 220, 'rangoMin' => 220, 'rangoMax' => 239],
            ['nombre' => 'Cloud Hosting Avanzado', 'costoBase' => 240, 'rangoMin' => 240, 'rangoMax' => 259],
            ['nombre' => 'Google Cloud', 'costoBase' => 260, 'rangoMin' => 260, 'rangoMax' => 279],
            ['nombre' => 'Google Cloud Premium', 'costoBase' => 280, 'rangoMin' => 280, 'rangoMax' => 299],
            ['nombre' => 'Sitio Web básico', 'costoBase' => 300, 'rangoMin' => 300, 'rangoMax' => 319],
            ['nombre' => 'Sitio Web Empresarial', 'costoBase' => 320, 'rangoMin' => 320, 'rangoMax' => 339],
            ['nombre' => 'Tienda Virtual', 'costoBase' => 340, 'rangoMin' => 340, 'rangoMax' => 359],
            ['nombre' => 'Portal Web', 'costoBase' => 360, 'rangoMin' => 360, 'rangoMax' => 379],
            ['nombre' => 'Portal web + Emails Zoho', 'costoBase' => 380, 'rangoMin' => 380, 'rangoMax' => 399],
            ['nombre' => 'Portal web + Diseño de logo', 'costoBase' => 400, 'rangoMin' => 400, 'rangoMax' => 419],
            ['nombre' => 'Portal web + Campaña Google Ads', 'costoBase' => 420, 'rangoMin' => 420, 'rangoMax' => 439],
            ['nombre' => 'Portal web + Campaña de Anuncios Facebook e Instagram', 'costoBase' => 440, 'rangoMin' => 440, 'rangoMax' => 459],
            ['nombre' => 'Portal web + Banner o Flyer Web', 'costoBase' => 460, 'rangoMin' => 460, 'rangoMax' => 479],
            ['nombre' => 'Portal web + Banner o Flyer Web Premium', 'costoBase' => 480, 'rangoMin' => 480, 'rangoMax' => 500],
        ];

        for ($i = 0; $i < count($costRanges); $i++) {
            Producto::create([
                'nombre' => $costRanges[$i]['nombre'],
                'costo_base' => $costRanges[$i]['costoBase'],
                'rango_min' => $costRanges[$i]['rangoMin'],
                'rango_max' => $costRanges[$i]['rangoMax']
            ]);
        }
    }
}
