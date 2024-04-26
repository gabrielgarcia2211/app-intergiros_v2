<?php

namespace Database\Seeders\Configuration;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoreMasterComboPaisTelefonoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'parent_id' => 1,
                'name' => 'Pais Telefono',
                'code' => 'pais_telefono',
                'description' => "",
                'is_father' => true,
                'status' => true,

                "childrens" => [
                    [
                        "name" => "+58",
                        "orden" => 1,
                        "valor" => "Venezuela"
                    ],
                    [
                        "name" => "+51",
                        "orden" => 2,
                        "valor" => "Perú"
                    ],
                    [
                        "name" => "+1",
                        "orden" => 3,
                        "valor" => "Estados Unidos"
                    ],
                    [
                        "name" => "+1",
                        "orden" => 4,
                        "valor" => "Canadá"
                    ],
                    [
                        "name" => "+52",
                        "orden" => 5,
                        "valor" => "México"
                    ],
                    [
                        "name" => "+55",
                        "orden" => 6,
                        "valor" => "Brasil"
                    ],
                    [
                        "name" => "+54",
                        "orden" => 7,
                        "valor" => "Argentina"
                    ],
                    [
                        "name" => "+593",
                        "orden" => 8,
                        "valor" => "Ecuador"
                    ],
                    [
                        "name" => "+53",
                        "orden" => 9,
                        "valor" => "Cuba"
                    ],
                    [
                        "name" => "+591",
                        "orden" => 10,
                        "valor" => "Bolivia"
                    ],
                    [
                        "name" => "+506",
                        "orden" => 11,
                        "valor" => "Costa Rica"
                    ],
                    [
                        "name" => "+507",
                        "orden" => 12,
                        "valor" => "Panamá"
                    ],
                    [
                        "name" => "+598",
                        "orden" => 13,
                        "valor" => "Uruguay"
                    ],
                    [
                        "name" => "+34",
                        "orden" => 14,
                        "valor" => "España"
                    ],
                    [
                        "name" => "+49",
                        "orden" => 15,
                        "valor" => "Alemania"
                    ],
                    [
                        "name" => "+33",
                        "orden" => 16,
                        "valor" => "Francia"
                    ],
                    [
                        "name" => "+39",
                        "orden" => 17,
                        "valor" => "Italia"
                    ],
                    [
                        "name" => "+44",
                        "orden" => 18,
                        "valor" => "Reino Unido"
                    ],
                    [
                        "name" => "+7",
                        "orden" => 19,
                        "valor" => "Rusia"
                    ],
                    [
                        "name" => "+380",
                        "orden" => 20,
                        "valor" => "Ucrania"
                    ],
                    [
                        "name" => "+48",
                        "orden" => 21,
                        "valor" => "Polonia"
                    ],
                    [
                        "name" => "+40",
                        "orden" => 22,
                        "valor" => "Rumania"
                    ],
                    [
                        "name" => "+31",
                        "orden" => 23,
                        "valor" => "Países Bajos"
                    ],
                    [
                        "name" => "+32",
                        "orden" => 24,
                        "valor" => "Bélgica"
                    ],
                    [
                        "name" => "+30",
                        "orden" => 25,
                        "valor" => "Grecia"
                    ],
                    [
                        "name" => "+351",
                        "orden" => 26,
                        "valor" => "Portugal"
                    ],
                    [
                        "name" => "+46",
                        "orden" => 27,
                        "valor" => "Suecia"
                    ],
                    [
                        "name" => "+47",
                        "orden" => 28,
                        "valor" => "Noruega"
                    ],
                    [
                        "name" => "+86",
                        "orden" => 29,
                        "valor" => "China"
                    ],
                    [
                        "name" => "+91",
                        "orden" => 30,
                        "valor" => "India"
                    ],
                    [
                        "name" => "+57",
                        "orden" => 31,
                        "valor" => "Colombia"
                    ],
                    [
                        "name" => "+56",
                        "orden" => 32,
                        "valor" => "Chile"
                    ],
                    [
                        "name" => "+81",
                        "orden" => 33,
                        "valor" => "Japón"
                    ],
                    [
                        "name" => "+82",
                        "orden" => 34,
                        "valor" => "Corea del Sur"
                    ],
                    [
                        "name" => "+62",
                        "orden" => 35,
                        "valor" => "Indonesia"
                    ],
                    [
                        "name" => "+90",
                        "orden" => 36,
                        "valor" => "Turquía"
                    ],
                    [
                        "name" => "+63",
                        "orden" => 37,
                        "valor" => "Filipinas"
                    ],
                    [
                        "name" => "+66",
                        "orden" => 38,
                        "valor" => "Tailandia"
                    ],
                    [
                        "name" => "+84",
                        "orden" => 39,
                        "valor" => "Vietnam"
                    ],
                    [
                        "name" => "+972",
                        "orden" => 40,
                        "valor" => "Israel"
                    ],
                    [
                        "name" => "+60",
                        "orden" => 41,
                        "valor" => "Malasia"
                    ],
                    [
                        "name" => "+65",
                        "orden" => 42,
                        "valor" => "Singapur"
                    ],
                    [
                        "name" => "+92",
                        "orden" => 43,
                        "valor" => "Pakistán"
                    ],
                    [
                        "name" => "+880",
                        "orden" => 44,
                        "valor" => "Bangladés"
                    ],
                    [
                        "name" => "+966",
                        "orden" => 45,
                        "valor" => "Arabia Saudita"
                    ],
                    [
                        "name" => "+20",
                        "orden" => 46,
                        "valor" => "Egipto"
                    ],
                    [
                        "name" => "+27",
                        "orden" => 47,
                        "valor" => "Sudáfrica"
                    ],
                    [
                        "name" => "+234",
                        "orden" => 48,
                        "valor" => "Nigeria"
                    ],
                    [
                        "name" => "+254",
                        "orden" => 49,
                        "valor" => "Kenia"
                    ],
                    [
                        "name" => "+212",
                        "orden" => 50,
                        "valor" => "Marruecos"
                    ],
                    [
                        "name" => "+213",
                        "orden" => 51,
                        "valor" => "Argelia"
                    ],
                    [
                        "name" => "+256",
                        "orden" => 52,
                        "valor" => "Uganda"
                    ],
                    [
                        "name" => "+233",
                        "orden" => 53,
                        "valor" => "Ghana"
                    ],
                    [
                        "name" => "+237",
                        "orden" => 54,
                        "valor" => "Camerún"
                    ],
                    [
                        "name" => "+225",
                        "orden" => 55,
                        "valor" => "Costa de Marfil"
                    ],
                    [
                        "name" => "+221",
                        "orden" => 56,
                        "valor" => "Senegal"
                    ],
                    [
                        "name" => "+255",
                        "orden" => 57,
                        "valor" => "Tanzania"
                    ],
                    [
                        "name" => "+249",
                        "orden" => 58,
                        "valor" => "Sudán"
                    ],
                    [
                        "name" => "+218",
                        "orden" => 59,
                        "valor" => "Libia"
                    ],
                    [
                        "name" => "+216",
                        "orden" => 60,
                        "valor" => "Túnez"
                    ],
                    [
                        "name" => "+61",
                        "orden" => 61,
                        "valor" => "Australia"
                    ],
                    [
                        "name" => "+64",
                        "orden" => 62,
                        "valor" => "Nueva Zelanda"
                    ],
                    [
                        "name" => "+679",
                        "orden" => 63,
                        "valor" => "Fiji"
                    ],
                    [
                        "name" => "+675",
                        "orden" => 64,
                        "valor" => "Papúa Nueva Guinea"
                    ],
                    [
                        "name" => "+676",
                        "orden" => 65,
                        "valor" => "Tonga"
                    ],
                    [
                        "name" => "+98",
                        "orden" => 66,
                        "valor" => "Irán"
                    ],
                    [
                        "name" => "+964",
                        "orden" => 67,
                        "valor" => "Iraq"
                    ],
                    [
                        "name" => "+962",
                        "orden" => 68,
                        "valor" => "Jordania"
                    ],
                    [
                        "name" => "+961",
                        "orden" => 69,
                        "valor" => "Líbano"
                    ],
                    [
                        "name" => "+965",
                        "orden" => 70,
                        "valor" => "Kuwait"
                    ],
                    [
                        "name" => "+971",
                        "orden" => 71,
                        "valor" => "Emiratos Árabes Unidos"
                    ],
                    [
                        "name" => "+968",
                        "orden" => 72,
                        "valor" => "Omán"
                    ],
                    [
                        "name" => "+974",
                        "orden" => 73,
                        "valor" => "Catar"
                    ],
                    [
                        "name" => "+973",
                        "orden" => 74,
                        "valor" => "Bahrein"
                    ],
                    [
                        "name" => "+967",
                        "orden" => 75,
                        "valor" => "Yemen"
                    ]
                ]
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
                        'valor1' => $child['valor'],
                        'status' => true
                    ]);
                }
            }
        }
    }
}
