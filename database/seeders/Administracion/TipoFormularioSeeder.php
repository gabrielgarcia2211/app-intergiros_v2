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
            ['descripcion' => 'Paypal', 'codigo' => 'TP-01'],
            ['descripcion' => 'Paypal-Venezuela', 'codigo' => 'TP-01-paypal-venezuela'],
            ['descripcion' => 'Paypal-Peru', 'codigo' => 'TP-01-paypal-peru'],
            ['descripcion' => 'Paypal-EEUU', 'codigo' => 'TP-01-paypal-peru-dolar'],
            ['descripcion' => 'Paypal-Colombia', 'codigo' => 'TP-01-paypal-colombia'],
            // TP-02
            ['descripcion' => 'USDT', 'codigo' => 'TP-02'],
            ['descripcion' => 'USDT-Venezuela', 'codigo' => 'TP-02-usdt-venezuela'],
            ['descripcion' => 'USDT-Peru', 'codigo' => 'TP-02-usdt-peru'],
            ['descripcion' => 'USDT-EEUU', 'codigo' => 'TP-02-usdt-peru-dolar'],
            ['descripcion' => 'USDT-Colombia', 'codigo' => 'TP-02-usdt-colombia'],
            // TP-03
            ['descripcion' => 'Zinli', 'codigo' => 'TP-03'],
            ['descripcion' => 'Zinli-Venezuela', 'codigo' => 'TP-03-zinli-venezuela'],
            // TP-04
            ['descripcion' => 'Peru', 'codigo' => 'TP-04'],
            ['descripcion' => 'Peru-Venezuela', 'codigo' => 'TP-04-peru-venezuela'],
            ['descripcion' => 'Peru-USD-Venezuela', 'codigo' => 'TP-04-peru-dolar-venezuela'],
            ['descripcion' => 'Peru-Colombia', 'codigo' => 'TP-04-peru-colombia'],
            ['descripcion' => 'Peru-USD-Colombia', 'codigo' => 'TP-04-peru-dolar-colombia'],
            // TP-05
            ['descripcion' => 'Colombia', 'codigo' => 'TP-05'],
            ['descripcion' => 'Colombia-Venezuela', 'codigo' => 'TP-05-colombia-venezuela'],
            ['descripcion' => 'Colombia-Peru', 'codigo' => 'TP-05-colombia-peru'],
            ['descripcion' => 'Colombia-Peru-USD', 'codigo' => 'TP-05-colombia-peru-dolar'],
            // TP-06
            ['descripcion' => 'Venezuela', 'codigo' => 'TP-06'],
            ['descripcion' => 'Venezuela-Colombia', 'codigo' => 'TP-06-venezuela-colombia'],
            ['descripcion' => 'Venezuela-Peru', 'codigo' => 'TP-06-venezuela-peru'],
            ['descripcion' => 'Venezuela-Peru-USD', 'codigo' => ' TP-06-venezuela-peru-dolar'],
            // TP-07
            ['descripcion' => 'Paises-Zinli', 'codigo' => 'TP-07'],
            ['descripcion' => 'Venezuela-Zinli', 'codigo' => 'TP-07-venezuela-zinli'],
            ['descripcion' => 'Colombia-Zinli', 'codigo' => 'TP-07-colombia-zinli'],
            ['descripcion' => 'Peru-Zinli', 'codigo' => 'TP-07-peru-zinli'],
            ['descripcion' => 'Peru-USD-Zinli', 'codigo' =>  'TP-07-peru-dolar-zinli'],
            // TP-08
            ['descripcion' => 'Paises-Paypal', 'codigo' => 'TP-08'],
            ['descripcion' => 'Venezuela-Paypal', 'codigo' => 'TP-08-venezuela-paypal'],
            ['descripcion' => 'Colombia-Paypal', 'codigo' => 'TP-08-colombia-paypal'],
            ['descripcion' => 'Peru-Paypal', 'codigo' => 'TP-08-peru-paypal'],
            ['descripcion' => 'Peru-USD-Paypal', 'codigo' =>  'TP-08-peru-dolar-paypal'],
        ];

        foreach ($tiposFormulario as $tipo) {
            TipoFormulario::create([
                'descripcion' => $tipo['descripcion'],
                'codigo' => $tipo['codigo'],
            ]);
        }
    }
}
