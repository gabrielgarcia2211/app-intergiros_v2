<?php

namespace Database\Seeders\Configuration;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoreMasterComboReclamoProcesadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'parent_id' => 1,
                'name' => 'Modal Reclamo Procesado',
                'code' => 'm_reclamo_procesado',
                'description' => "",
                'is_father' => true,
                'status' => true,
                'childrens' => [
                    [
                        'name' => 'reintentar',
                        'code' => 'reintentar_p',
                        'orden' => 0,
                        'valor1' => 'Procesar nuevamente en la misma cuenta',
                    ],
                    [
                        'name' => 'reintentar_beneficiario',
                        'code' => 'reintentar_beneficiario_p',
                        'orden' => 1,
                        'valor1' => 'Procesar en otra cuenta',
                    ],
                    [
                        'name' => 'reembolso',
                        'code' => 'reembolso_p',
                        'orden' => 2,
                        'valor1' => 'Solicitar reembolso',
                    ]
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
                        'orden' => $child['orden'],
                        'valor1' => $child['valor1'],
                        'status' => true
                    ]);
                }
            }
        }
    }
}
