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
            ['descripcion' => 'Paypal-Venezuela', 'codigo' => 'TP-01-VED'],
            ['descripcion' => 'Paypal-Peru', 'codigo' => 'TP-01-PEN'],
            ['descripcion' => 'Paypal-EEUU', 'codigo' => 'TP-01-USD'],
            ['descripcion' => 'Paypal-Colombia', 'codigo' => 'TP-01-COP'],

            ['descripcion' => 'Usdt', 'codigo' => 'TP-02'],
            ['descripcion' => 'Usdt-Venezuela', 'codigo' => 'TP-02-VED'],
            ['descripcion' => 'Usdt-Peru', 'codigo' => 'TP-02-PEN'],
            ['descripcion' => 'Usdt-EEUU', 'codigo' => 'TP-02-USD'],
            ['descripcion' => 'Usdt-Colombia', 'codigo' => 'TP-02-COP'],

            ['descripcion' => 'Zinli', 'codigo' => 'TP-03'],
            ['descripcion' => 'Zinli-Venezuela', 'codigo' => 'TP-03-VED'],





            ['descripcion' => 'Skrill', 'codigo' => 'TP-02'],
            ['descripcion' => 'Bitcoin', 'codigo' => 'TP-03'],
            ['descripcion' => 'Tehther', 'codigo' => 'TP-04'],
            ['descripcion' => 'Peru Sol', 'codigo' => 'TP-05'],
            ['descripcion' => 'Peru Dolar', 'codigo' => 'TP-06'],
            ['descripcion' => 'Colombia Bolivar', 'codigo' => 'TP-07'],


          


          
        ];

        foreach ($tiposFormulario as $tipo) {
            TipoFormulario::create([
                'descripcion' => $tipo['descripcion'],
                'codigo' => $tipo['codigo'],
            ]);
        }
    }
}
