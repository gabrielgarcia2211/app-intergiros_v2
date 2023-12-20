<?php

namespace Database\Seeders\Administracion;

use Illuminate\Database\Seeder;
use App\Models\Administracion\TipoFormulario;

class TipoFormularioSeeder extends Seeder
{

    public function run(): void
    {
        $tiposFormulario = [
            'Paypal',
            'Skrill',
            'Bitcoin',
            'Tehther',
            'Peru Sol',
            'Peru Dolar',
            'Colombia Bolivar',
            'Zinli',
        ];

        foreach ($tiposFormulario as $index => $descripcion) {
            TipoFormulario::create([
                'descripcion' => $descripcion,
            ]);
        }
    }
}
