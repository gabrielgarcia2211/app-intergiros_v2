<?php

namespace Database\Seeders\Configuration;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoreMasterComboReclamoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'parent_id' => 1,
                'name' => 'Modal Reclamo',
                'code' => 'modal_reclamo',
                'description' => "",
                'is_father' => true,
                'status' => true,
                'childrens' => [
                    [
                        'name' => 'llamado',
                        'orden' => 0,
                        'valor1' => 'Llamado de atención para que se procese mi pedido',
                    ],
                    [
                        'name' => 'reembolso',
                        'orden' => 1,
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
                        'orden' => $child['orden'],
                        'valor1' => $child['valor1'],
                        'status' => true
                    ]);
                }
            }
        }
    }
}
