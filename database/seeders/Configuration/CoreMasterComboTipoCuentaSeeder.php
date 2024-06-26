<?php

namespace Database\Seeders\Configuration;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoreMasterComboTipoCuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'parent_id' => 1,
                'name' => 'Tipo Cuenta',
                'code' => 'tipo_cuenta',
                'description' => "",
                'is_father' => true,
                'status' => true,
                'childrens' => [
                    [
                        'name' => 'A-AHORRO',
                        'code' => 'ahorro',
                        'orden' => 0,
                        'valor1' => 'A',
                    ],
                    [
                        'name' => 'C-CORRIENTE',
                        'code' => 'corriente',
                        'orden' => 1,
                        'valor1' => 'C',
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
                        'code' => $child['code'],
                        'status' => true
                    ]);
                }
            }
        }
    }
}
