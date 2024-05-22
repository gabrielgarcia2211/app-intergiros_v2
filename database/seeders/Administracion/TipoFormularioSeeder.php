<?php

namespace Database\Seeders\Administracion;

use Illuminate\Database\Seeder;
use App\Models\Administracion\TipoFormulario;

class TipoFormularioSeeder extends Seeder
{

    public function run(): void
    {
        $tiposFormulario = [
            // TP-01
            ['descripcion' => 'Paypal', 'codigo' => 'TP-01', 'principal' => 1],
            ['descripcion' => 'Paypal-Venezuela', 'codigo' => 'TP-01-VES', 'principal' => 0],
            ['descripcion' => 'Paypal-Peru', 'codigo' => 'TP-01-PEN', 'principal' => 0],
            ['descripcion' => 'Paypal-EEUU', 'codigo' => 'TP-01-USD', 'principal' => 0],
            ['descripcion' => 'Paypal-Colombia', 'codigo' => 'TP-01-COP', 'principal' => 0],
            // TP-02
            ['descripcion' => 'USDT', 'codigo' => 'TP-02', 'principal' => 1],
            ['descripcion' => 'USDT-Venezuela', 'codigo' => 'TP-02-VES', 'principal' => 0],
            ['descripcion' => 'USDT-Peru', 'codigo' => 'TP-02-PEN', 'principal' => 0],
            ['descripcion' => 'USDT-EEUU', 'codigo' => 'TP-02-USD', 'principal' => 0],
            ['descripcion' => 'USDT-Colombia', 'codigo' => 'TP-02-COP', 'principal' => 0],
            // TP-03
            ['descripcion' => 'Zinli', 'codigo' => 'TP-03', 'principal' => 1],
            ['descripcion' => 'Zinli-Venezuela', 'codigo' => 'TP-03-VES', 'principal' => 0],
            // TP-04
            ['descripcion' => 'Peru', 'codigo' => 'TP-04', 'principal' => 1],
            ['descripcion' => 'Peru-Venezuela', 'codigo' => 'TP-04-VES', 'principal' => 0],
            ['descripcion' => 'Peru-Colombia', 'codigo' => 'TP-04-COP', 'principal' => 0],
            // TP-05
            ['descripcion' => 'USD', 'codigo' => 'TP-05', 'principal' => 1],
            ['descripcion' => 'Peru-USD-Venezuela', 'codigo' => 'TP-05-VES', 'principal' => 0],
            ['descripcion' => 'Peru-USD-Colombia', 'codigo' => 'TP-05-COP', 'principal' => 0],
            // TP-06
            ['descripcion' => 'Colombia', 'codigo' => 'TP-06', 'principal' => 2],
            ['descripcion' => 'Colombia-Venezuela', 'codigo' => 'TP-06-VES', 'principal' => 0],
            ['descripcion' => 'Colombia-Peru', 'codigo' => 'TP-06-PEN', 'principal' => 0],
            ['descripcion' => 'Colombia-Peru-USD', 'codigo' => 'TP-06-USD', 'principal' => 0],
            // TP-07
            ['descripcion' => 'Venezuela', 'codigo' => 'TP-07', 'principal' => 2],
            ['descripcion' => 'Venezuela-Colombia', 'codigo' => 'TP-07-COP', 'principal' => 0],
            ['descripcion' => 'Venezuela-Peru', 'codigo' => 'TP-07-PEN', 'principal' => 0],
            ['descripcion' => 'Venezuela-Peru-USD', 'codigo' => ' TP-07-USD', 'principal' => 0],
            // TP-08
            ['descripcion' => 'P-Zinli', 'codigo' => 'TP-08', 'principal' => 2],
            ['descripcion' => 'Venezuela-Zinli', 'codigo' => 'TP-08-VES', 'principal' => 0],
            ['descripcion' => 'Colombia-Zinli', 'codigo' => 'TP-08-COP', 'principal' => 0],
            ['descripcion' => 'Peru-Zinli', 'codigo' => 'TP-08-PEN', 'principal' => 0],
            ['descripcion' => 'Peru-USD-Zinli', 'codigo' =>  'TP-08-USD', 'principal' => 0],
            // TP-09
            ['descripcion' => 'P-Paypal', 'codigo' => 'TP-09', 'principal' => 2],
            ['descripcion' => 'Venezuela-Paypal', 'codigo' => 'TP-09-VES', 'principal' => 0],
            ['descripcion' => 'Colombia-Paypal', 'codigo' => 'TP-09-COP', 'principal' => 0],
            ['descripcion' => 'Peru-Paypal', 'codigo' => 'TP-09-PEN', 'principal' => 0],
            ['descripcion' => 'Peru-USD-Paypal', 'codigo' =>  'TP-09-USD', 'principal' => 0],
        ];

        foreach ($tiposFormulario as $tipo) {
            TipoFormulario::create([
                'descripcion' => $tipo['descripcion'],
                'codigo' => $tipo['codigo'],
                'principal' => $tipo['principal'],
            ]);
        }
    }
}
