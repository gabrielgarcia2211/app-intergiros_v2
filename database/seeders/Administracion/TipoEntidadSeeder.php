<?php

namespace Database\Seeders\Administracion;

use Illuminate\Database\Seeder;
use App\Models\Administracion\TipoEntidad;

class TipoEntidadSeeder extends Seeder
{

    public function run()
    {

        $tiposEntidad = [
            ['descripcion' => 'PayPal'],
            ['descripcion' => 'Skrill'],
            ['descripcion' => 'Bitcoin'],
            ['descripcion' => 'Tehther'],
            ['descripcion' => 'PeruSol'],
            ['descripcion' => 'PeruDolar'],
            ['descripcion' => 'ColombiaBolivar'],
            ['descripcion' => 'Zinli'],
        ];

        foreach ($tiposEntidad as $tipoEntidad) {
            TipoEntidad::create($tipoEntidad);
        }
    }
}
