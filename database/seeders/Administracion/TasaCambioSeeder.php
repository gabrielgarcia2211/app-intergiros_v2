<?php

namespace Database\Seeders\Administracion;

use Illuminate\Database\Seeder;
use App\Models\Administracion\TasaCambio;
use App\Models\Administracion\TipoFormulario;

class TasaCambioSeeder extends Seeder
{
    public function run()
    {
        TasaCambio::truncate();

        // Obtener IDs de tipos de formulario
        $tipoFormularioIds = TipoFormulario::pluck('id')->toArray();

        for ($i = 0; $i < 8; $i++) {
            TasaCambio::create([
                'valor' => rand(1, 100), // Valor de la tasa de cambio
                'tipo_formulario_id' => $tipoFormularioIds[$i],
            ]);
        }
    }
}
