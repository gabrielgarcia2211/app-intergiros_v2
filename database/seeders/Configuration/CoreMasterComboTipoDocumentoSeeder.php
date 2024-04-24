<?php

namespace Database\Seeders\Configuration;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoreMasterComboTipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'parent_id' => 1,
                'name' => 'Tipo Documento',
                'code' => 'tipo_documento',
                'description' => "",
                'is_father' => true,
                'status' => true,
                'childrens' => [
                    [
                        'name' => 'CI-V',
                        'valor1' => 'VES',
                        'valor2' => 'Cédula Venezolana',
                    ],
                    [
                        'name' => 'CI-E',
                        'valor1' => 'VES',
                        'valor2' => 'Cédula Extranjera',
                    ],
                    [
                        'name' => 'J',
                        'valor1' => 'VES',
                        'valor2' => 'Jurídico',
                    ],
                    [
                        'name' => 'P',
                        'valor1' => 'VES',
                        'valor2' => 'Pasaporte',
                    ],
                    [
                        'name' => 'CC',
                        'valor1' => 'COP',
                        'valor2' => 'Cédula de ciudadanía',
                    ],
                    [
                        'name' => 'CE',
                        'valor1' => 'COP',
                        'valor2' => 'Carnet de extranjería',
                    ],
                    [
                        'name' => 'P',
                        'valor1' => 'COP',
                        'valor2' => 'Pasaporte',
                    ],
                    [
                        'name' => 'CE',
                        'valor1' => 'PEN',
                        'valor2' => 'Carnet de extranjería',
                    ],
                    [
                        'name' => 'CPP',
                        'valor1' => 'PEN',
                        'valor2' => 'Carnet de permiso temporal de permanencia',
                    ],
                    [
                        'name' => 'P',
                        'valor1' => 'PEN',
                        'valor2' => 'Pasaporte',
                    ],
                    [
                        'name' => 'CI',
                        'valor1' => 'PEN',
                        'valor2' => 'Cédula de identidad',
                    ],
                    [
                        'name' => 'DNI',
                        'valor1' => 'PEN',
                        'valor2' => 'Documento de Identidad',
                    ],
                    [
                        'name' => 'CE',
                        'valor1' => 'USD',
                        'valor2' => 'Carnet de extranjería',
                    ],
                    [
                        'name' => 'CPP',
                        'valor1' => 'USD',
                        'valor2' => 'Carnet de permiso temporal de permanencia',
                    ],
                    [
                        'name' => 'P',
                        'valor1' => 'USD',
                        'valor2' => 'Pasaporte',
                    ],
                    [
                        'name' => 'CI',
                        'valor1' => 'USD',
                        'valor2' => 'Cédula de identidad',
                    ],
                    [
                        'name' => 'DNI',
                        'valor1' => 'USD',
                        'valor2' => 'Documento de Identidad',
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
                        'code' => strtolower(str_replace(' ', '_',  $this->removeAccents($child['name']))) . "_" . strtolower($child['valor1']),
                        'valor1' => $child['valor1'],
                        'valor2' => $child['valor2'],
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
