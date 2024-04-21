<?php

namespace Database\Seeders\Configuration;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoreMasterComboBancosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'parent_id' => 1,
                'name' => 'Bancos',
                'code' => 'banco',
                'description' => "",
                'is_father' => true,
                'status' => true,
                'childrens' => [
                    [
                        'name' => 'Banco de Venezuela',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Banco Agrícola de Venezuela',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Bancaribe',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Banco Caroní',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Banco Exterior',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Banco Plaza',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Banco del Tesoro',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Bancrecer',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Banco Activo',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Bancamiga',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Banco Del Sur',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Banplus',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Banfanb',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'BFC Banco Fondo Común',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Bicentenario del Pueblo',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'BNC Nacional de Crédito',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Mercantil',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Mi Banco',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Provincial',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'Venezolano de Crédito',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => '100% Banco',
                        'valor1' => 'VES',
                    ],
                    [
                        'name' => 'BCP',
                        'valor1' => 'PEN',
                    ],
                    [
                        'name' => 'Interbank',
                        'valor1' => 'PEN',
                    ],
                    [
                        'name' => 'BBVA',
                        'valor1' => 'PEN',
                    ],
                    [
                        'name' => 'Scotiabank',
                        'valor1' => 'PEN',
                    ],
                    [
                        'name' => 'Banco Pichincha',
                        'valor1' => 'PEN',
                    ],
                    [
                        'name' => 'Banbif',
                        'valor1' => 'PEN',
                    ],
                    [
                        'name' => 'Banco de la Nación',
                        'valor1' => 'PEN',
                    ],
                    [
                        'name' => 'Banco de Comercio',
                        'valor1' => 'PEN',
                    ],
                    [
                        'name' => 'Citibank',
                        'valor1' => 'PEN',
                    ],
                    [
                        'name' => 'MiBanco',
                        'valor1' => 'PEN',
                    ],
                    [
                        'name' => 'Bancolombia',
                        'valor1' => 'COP'
                    ],
                    [
                        'name' => 'Banco de Bogotá',
                        'valor1' => 'COP'
                    ],
                    [
                        'name' => 'Banco de Occidente',
                        'valor1' => 'COP'
                    ],
                    [
                        'name' => 'Davivienda',
                        'valor1' => 'COP'
                    ],
                    [
                        'name' => 'Scotiabank Colpatria',
                        'valor1' => 'COP'
                    ],
                    [
                        'name' => 'Banco Popular',
                        'valor1' => 'COP'
                    ],
                    [
                        'name' => 'BBVA Colombia',
                        'valor1' => 'COP'
                    ],
                    [
                        'name' => 'Itaú',
                        'valor1' => 'COP'
                    ],
                ],
            ],
        ];

        foreach ($items as $key => $item) {
            $temp_children = null;
            if (isset($item['childrens'])) {
                $temp_children = $item['childrens'];
                unset($item['childrens']);
            }

            # Creamos el padre y vinculamos los hijos
            $father_id = DB::table('master_combos')->insertGetId($item);

            if (!empty($temp_children)) {
                foreach ($temp_children as $child) {
                    DB::table('master_combos')->insert([
                        'parent_id' => $father_id,
                        'name' => $child['name'],
                        'code' => strtolower(str_replace(' ', '_',  $this->removeAccents($child['name']))),
                        'valor1' => $child['valor1'],
                        'status' => true
                    ]);
                }
            }
        }
    }

    function removeAccents($cadena)
    {
        $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $cadena = utf8_decode($cadena);
        $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
        return utf8_encode($cadena);
    }
}
