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
            ['descripcion' => 'Paypal-Venezuela', 'codigo' => 'TP-01-paypal-venezuela', 'principal' => 0],
            ['descripcion' => 'Paypal-Peru', 'codigo' => 'TP-01-paypal-peru', 'principal' => 0],
            ['descripcion' => 'Paypal-EEUU', 'codigo' => 'TP-01-paypal-peru-dolar', 'principal' => 0],
            ['descripcion' => 'Paypal-Colombia', 'codigo' => 'TP-01-paypal-colombia', 'principal' => 0],
            // TP-02
            ['descripcion' => 'USDT', 'codigo' => 'TP-02', 'principal' => 1],
            ['descripcion' => 'USDT-Venezuela', 'codigo' => 'TP-02-usdt-venezuela', 'principal' => 0],
            ['descripcion' => 'USDT-Peru', 'codigo' => 'TP-02-usdt-peru', 'principal' => 0],
            ['descripcion' => 'USDT-EEUU', 'codigo' => 'TP-02-usdt-peru-dolar', 'principal' => 0],
            ['descripcion' => 'USDT-Colombia', 'codigo' => 'TP-02-usdt-colombia', 'principal' => 0],
            // TP-03
            ['descripcion' => 'Zinli', 'codigo' => 'TP-03', 'principal' => 1],
            ['descripcion' => 'Zinli-Venezuela', 'codigo' => 'TP-03-zinli-venezuela', 'principal' => 0],
            // TP-04
            ['descripcion' => 'Peru', 'codigo' => 'TP-04', 'principal' => 2],
            ['descripcion' => 'Peru-Venezuela', 'codigo' => 'TP-04-peru-venezuela', 'principal' => 0],
            ['descripcion' => 'Peru-USD-Venezuela', 'codigo' => 'TP-04-peru-dolar-venezuela', 'principal' => 0],
            ['descripcion' => 'Peru-Colombia', 'codigo' => 'TP-04-peru-colombia', 'principal' => 0],
            ['descripcion' => 'Peru-USD-Colombia', 'codigo' => 'TP-04-peru-dolar-colombia', 'principal' => 0],
            // TP-05
            ['descripcion' => 'Colombia', 'codigo' => 'TP-05', 'principal' => 2],
            ['descripcion' => 'Colombia-Venezuela', 'codigo' => 'TP-05-colombia-venezuela', 'principal' => 0],
            ['descripcion' => 'Colombia-Peru', 'codigo' => 'TP-05-colombia-peru', 'principal' => 0],
            ['descripcion' => 'Colombia-Peru-USD', 'codigo' => 'TP-05-colombia-peru-dolar', 'principal' => 0],
            // TP-06
            ['descripcion' => 'Venezuela', 'codigo' => 'TP-06', 'principal' => 2],
            ['descripcion' => 'Venezuela-Colombia', 'codigo' => 'TP-06-venezuela-colombia', 'principal' => 0],
            ['descripcion' => 'Venezuela-Peru', 'codigo' => 'TP-06-venezuela-peru', 'principal' => 0],
            ['descripcion' => 'Venezuela-Peru-USD', 'codigo' => ' TP-06-venezuela-peru-dolar', 'principal' => 0],
            // TP-07
            ['descripcion' => 'Paises-Zinli', 'codigo' => 'TP-07', 'principal' => 2],
            ['descripcion' => 'Venezuela-Zinli', 'codigo' => 'TP-07-venezuela-zinli', 'principal' => 0],
            ['descripcion' => 'Colombia-Zinli', 'codigo' => 'TP-07-colombia-zinli', 'principal' => 0],
            ['descripcion' => 'Peru-Zinli', 'codigo' => 'TP-07-peru-zinli', 'principal' => 0],
            ['descripcion' => 'Peru-USD-Zinli', 'codigo' =>  'TP-07-peru-dolar-zinli', 'principal' => 0],
            // TP-08
            ['descripcion' => 'Paises-Paypal', 'codigo' => 'TP-08', 'principal' => 2],
            ['descripcion' => 'Venezuela-Paypal', 'codigo' => 'TP-08-venezuela-paypal', 'principal' => 0],
            ['descripcion' => 'Colombia-Paypal', 'codigo' => 'TP-08-colombia-paypal', 'principal' => 0],
            ['descripcion' => 'Peru-Paypal', 'codigo' => 'TP-08-peru-paypal', 'principal' => 0],
            ['descripcion' => 'Peru-USD-Paypal', 'codigo' =>  'TP-08-peru-dolar-paypal', 'principal' => 0],
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
