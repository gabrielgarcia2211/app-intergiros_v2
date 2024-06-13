<?php

namespace Database\Seeders\Administracion;

use Illuminate\Database\Seeder;
use App\Models\Administracion\TipoMoneda;

class TipoMonedaSeeder extends Seeder
{
    public function run()
    {

        $tiposMoneda = [
            ['codigo' => 'VES', 'tipo' => 'Bolivar', 'descripcion' => 'Moneda de Venezuela'],
            ['codigo' => 'PEN', 'tipo' => 'Sol', 'descripcion' => 'Moneda de Perú'],
            ['codigo' => 'USD', 'tipo' => 'Dolar', 'descripcion' => 'Moneda de EEUU'],
            ['codigo' => 'COP', 'tipo' => 'Peso', 'descripcion' => 'Moneda de Colombia'],
        ];

        foreach ($tiposMoneda as $tipoMoneda) {
            TipoMoneda::create($tipoMoneda);
        }
    }
}
