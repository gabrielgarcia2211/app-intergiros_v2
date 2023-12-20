<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(Rols\RolesAndPermissionsSeeder::class);
        $this->call(Users\UsersSeeder::class);

        // Combos
        $this->call(Configuration\CoreMastersTableSeeder::class);
        $this->call(Configuration\CoreMasterComboPaisSeeder::class);
        $this->call(Configuration\CoreMasterComboPaisTelefonoSeeder::class);
        $this->call(Configuration\CoreMasterComboRedesSeeder::class);
        $this->call(Configuration\CoreMasterComboTipoDocumentoSeeder::class);

        // Tipos de cambio
        $this->call(Administracion\TipoEntidadSeeder::class);
        $this->call(Administracion\TipoMonedaSeeder::class);
        $this->call(Administracion\TipoFormularioSeeder::class);
        $this->call(Administracion\TasaCambioSeeder::class);
    }
}
