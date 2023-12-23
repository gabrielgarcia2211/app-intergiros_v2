<?php

namespace Database\Seeders\Administracion;

use Illuminate\Database\Seeder;
use App\Models\Administracion\TipoFormulario;

class TipoFormularioSeeder extends Seeder
{

    public function run(): void
    {
        $tiposFormulario = [
            ['descripcion' => 'Paypal', 'codigo' => 'TP-01'],
            ['descripcion' => 'Skrill', 'codigo' => 'TP-02'],
            ['descripcion' => 'Bitcoin', 'codigo' => 'TP-03'],
            ['descripcion' => 'Tehther', 'codigo' => 'TP-04'],
            ['descripcion' => 'Peru Sol', 'codigo' => 'TP-05'],
            ['descripcion' => 'Peru Dolar', 'codigo' => 'TP-06'],
            ['descripcion' => 'Colombia Bolivar', 'codigo' => 'TP-07'],
            ['descripcion' => 'Zinli', 'codigo' => 'TP-08'],
        ];

        foreach ($tiposFormulario as $tipo) {
            TipoFormulario::create([
                'descripcion' => $tipo['descripcion'],
                'codigo' => $tipo['codigo'],
            ]);
        }
    }
}
