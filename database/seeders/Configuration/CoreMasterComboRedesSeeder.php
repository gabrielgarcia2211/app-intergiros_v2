<?php

namespace Database\Seeders\Configuration;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoreMasterComboRedesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'parent_id' => 1,
                'name' => 'Redes',
                'code' => 'redes',
                'description' => "",
                'is_father' => true,
                'status' => true,
                'childrens' => [
                    [
                        'name' => 'Facebook',
                        'orden' => 0,
                    ],
                    [
                        'name' => 'Instagram',
                        'orden' => 1,
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
                        'status' => true
                    ]);
                }
            }
        }
    }
}
