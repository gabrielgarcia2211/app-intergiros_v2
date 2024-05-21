<?php

namespace Database\Seeders\Configuration;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoreMasterComboTipoDocumentoRegistroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'parent_id' => 1,
                'name' => 'Tipo Documento Registro',
                'code' => 'tipo_documento_registro',
                'description' => "",
                'is_father' => true,
                'status' => true,
                'childrens' => [
                    ["name" => "CI-V", "code" => "ci-v_registro"],
                    ["name" => "CI-E", "code" => "ci-e_registro"],
                    ["name" => "J", "code" => "j_registro"],
                    ["name" => "P", "code" => "p_registro"],
                    ["name" => "CC", "code" => "cc_registro"],
                    ["name" => "CE", "code" => "ce_registro"],
                    ["name" => "CPP", "code" => "cpp_registro"],
                    ["name" => "CI", "code" => "ci_registro"],
                    ["name" => "DNI", "code" => "dni_registro"],
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
                        'code' => $child['code'],
                        'valor1' => $child['code'],
                        'status' => true
                    ]);
                }
            }
        }
    }
}
