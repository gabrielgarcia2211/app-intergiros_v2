<?php

namespace Database\Seeders\Configuration;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoreMasterComboPaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'parent_id' => 1,
                'name' => 'Pais',
                'code' => 'pais',
                'description' => "",
                'is_father' => true,
                'status' => true,
                'childrens' => [
                    ['name' => 'Afganistán','orden' =>  0,],
                    ['name' => 'Albania','orden' =>  1],
                    ['name' => 'Alemania','orden' =>  2],
                    ['name' => 'Andorra','orden' =>  3],
                    ['name' => 'Angola','orden' =>  4],
                    ['name' => 'Antigua y Barbuda','orden' =>  5],
                    ['name' => 'Arabia Saudita','orden' =>  6],
                    ['name' => 'Argelia','orden' =>  7],
                    ['name' => 'Argentina','orden' =>  8],
                    ['name' => 'Armenia','orden' =>  9],
                    ['name' => 'Australia','orden' =>  10],
                    ['name' => 'Austria','orden' =>  11],
                    ['name' => 'Azerbaiyán','orden' =>  12],
                    ['name' => 'Bahamas','orden' =>  13],
                    ['name' => 'Bangladés','orden' =>  14],
                    ['name' => 'Barbados','orden' =>  15],
                    ['name' => 'Baréin','orden' =>  16],
                    ['name' => 'Bélgica','orden' =>  17],
                    ['name' => 'Belice','orden' =>  18],
                    ['name' => 'Benín','orden' =>  19],
                    ['name' => 'Bielorrusia','orden' =>  20],
                    ['name' => 'Birmania','orden' =>  21],
                    ['name' => 'Bolivia','orden' =>  22],
                    ['name' => 'Bosnia y Herzegovina','orden' =>  23],
                    ['name' => 'Botsuana','orden' =>  24],
                    ['name' => 'Brasil','orden' =>  25],
                    ['name' => 'Brunéi','orden' =>  26],
                    ['name' => 'Bulgaria','orden' =>  27],
                    ['name' => 'Burkina Faso','orden' =>  28],
                    ['name' => 'Burundi','orden' =>  29],
                    ['name' => 'Bután','orden' =>  30],
                    ['name' => 'Cabo Verde','orden' =>  31],
                    ['name' => 'Camboya','orden' =>  32],
                    ['name' => 'Camerún','orden' =>  33],
                    ['name' => 'Canadá','orden' =>  34],
                    ['name' => 'Catar','orden' =>  35],
                    ['name' => 'Chad','orden' =>  36],
                    ['name' => 'Chile','orden' =>  37],
                    ['name' => 'China','orden' =>  38],
                    ['name' => 'Chipre','orden' =>  39],
                    ['name' => 'Ciudad del Vaticano','orden' =>  40],
                    ['name' => 'Colombia','orden' =>  41],
                    ['name' => 'Comoras','orden' =>  42],
                    ['name' => 'Corea del Norte','orden' =>  43],
                    ['name' => 'Corea del Sur','orden' =>  44],
                    ['name' => 'Costa de Marfil','orden' =>  45],
                    ['name' => 'Costa Rica','orden' =>  46],
                    ['name' => 'Croacia','orden' =>  47],
                    ['name' => 'Cuba','orden' =>  48],
                    ['name' => 'Dinamarca','orden' =>  49],
                    ['name' => 'Dominica','orden' =>  50],
                    ['name' => 'Ecuador','orden' =>  51],
                    ['name' => 'Egipto','orden' =>  52],
                    ['name' => 'El Salvador','orden' =>  53],
                    ['name' => 'Emiratos Árabes Unidos','orden' =>  54],
                    ['name' => 'Eritrea','orden' =>  55],
                    ['name' => 'Eslovaquia','orden' =>  56],
                    ['name' => 'Eslovenia','orden' =>  57],
                    ['name' => 'España','orden' =>  58],
                    ['name' => 'Estados Unidos','orden' =>  59],
                    ['name' => 'Estonia','orden' =>  60],
                    ['name' => 'Etiopía','orden' =>  61],
                    ['name' => 'Filipinas','orden' =>  62],
                    ['name' => 'Finlandia','orden' =>  63],
                    ['name' => 'Fiyi','orden' =>  64],
                    ['name' => 'Francia','orden' =>  65],
                    ['name' => 'Gabón','orden' =>  66],
                    ['name' => 'Gambia','orden' =>  67],
                    ['name' => 'Georgia','orden' =>  68],
                    ['name' => 'Ghana','orden' =>  69],
                    ['name' => 'Granada','orden' =>  70],
                    ['name' => 'Grecia','orden' =>  71],
                    ['name' => 'Guatemala','orden' =>  72],
                    ['name' => 'Guyana','orden' =>  73],
                    ['name' => 'Guinea','orden' =>  74],
                    ['name' => 'Guinea ecuatorial','orden' =>  75],
                    ['name' => 'Guinea-Bisáu','orden' =>  76],
                    ['name' => 'Haití','orden' =>  77],
                    ['name' => 'Honduras','orden' =>  78],
                    ['name' => 'Hungría','orden' =>  79],
                    ['name' => 'India','orden' =>  80],
                    ['name' => 'Indonesia','orden' =>  81],
                    ['name' => 'Irak','orden' =>  82],
                    ['name' => 'Irán','orden' =>  83],
                    ['name' => 'Irlanda','orden' =>  84],
                    ['name' => 'Islandia','orden' =>  85],
                    ['name' => 'Islas Marshall','orden' =>  86],
                    ['name' => 'Islas Salomón','orden' =>  87],
                    ['name' => 'Israel','orden' =>  88],
                    ['name' => 'Italia','orden' =>  89],
                    ['name' => 'Jamaica','orden' =>  90],
                    ['name' => 'Japón','orden' =>  91],
                    ['name' => 'Jordania','orden' =>  92],
                    ['name' => 'Kazajistán','orden' =>  93],
                    ['name' => 'Kenia','orden' =>  94],
                    ['name' => 'Kirguistán','orden' =>  95],
                    ['name' => 'Kiribati','orden' =>  96],
                    ['name' => 'Kuwait','orden' =>  97],
                    ['name' => 'Laos','orden' =>  98],
                    ['name' => 'Lesoto','orden' =>  99],
                    ['name' => 'Letonia','orden' =>  100],
                    ['name' => 'Líbano','orden' =>  101],
                    ['name' => 'Liberia','orden' =>  102],
                    ['name' => 'Libia','orden' =>  103],
                    ['name' => 'Liechtenstein','orden' =>  104],
                    ['name' => 'Lituania','orden' =>  105],
                    ['name' => 'Luxemburgo','orden' =>  106],
                    ['name' => 'Macedonia del Norte','orden' =>  107],
                    ['name' => 'Madagascar','orden' =>  108],
                    ['name' => 'Malasia','orden' =>  109],
                    ['name' => 'Malaui','orden' =>  110],
                    ['name' => 'Maldivas','orden' =>  111],
                    ['name' => 'Maldivas','orden' =>  112],
                    ['name' => 'Malta','orden' =>  113],
                    ['name' => 'Marruecos','orden' =>  114],
                    ['name' => 'Mauricio','orden' =>  115],
                    ['name' => 'Mauritania','orden' =>  116],
                    ['name' => 'México','orden' =>  117],
                    ['name' => 'Micronesia','orden' =>  118],
                    ['name' => 'Moldavia','orden' =>  119],
                    ['name' => 'Mónaco','orden' =>  120],
                    ['name' => 'Mongolia','orden' =>  121],
                    ['name' => 'Montenegro','orden' =>  122],
                    ['name' => 'Mozambique','orden' =>  123],
                    ['name' => 'Namibia','orden' =>  124],
                    ['name' => 'Nauru','orden' =>  125],
                    ['name' => 'Nepal','orden' =>  126],
                    ['name' => 'Nicaragua','orden' =>  127],
                    ['name' => 'Níger','orden' =>  128],
                    ['name' => 'Nigeria','orden' =>  129],
                    ['name' => 'Noruega','orden' =>  130],
                    ['name' => 'Nueva Zelanda','orden' =>  131],
                    ['name' => 'Omán','orden' =>  132],
                    ['name' => 'Países Bajos','orden' =>  133],
                    ['name' => 'Pakistán','orden' =>  134],
                    ['name' => 'Palaos','orden' =>  135],
                    ['name' => 'Panamá','orden' =>  136],
                    ['name' => 'Papúa Nueva Guinea','orden' =>  137],
                    ['name' => 'Paraguay','orden' =>  138],
                    ['name' => 'Perú','orden' =>  139],
                    ['name' => 'Polonia','orden' =>  140],
                    ['name' => 'Portugal','orden' =>  141],
                    ['name' => 'Reino Unido','orden' =>  142],
                    ['name' => 'República Centroafricana','orden' =>  143],
                    ['name' => 'República Checa','orden' =>  144],
                    ['name' => 'República del Congo','orden' =>  145],
                    ['name' => 'República Democrática del Congo','orden' =>  146],
                    ['name' => 'República Dominicana','orden' =>  147],
                    ['name' => 'República Sudafricana','orden' =>  148],
                    ['name' => 'Ruanda','orden' =>  149],
                    ['name' => 'Rumanía','orden' =>  150],
                    ['name' => 'Rusia','orden' =>  151],
                    ['name' => 'Samoa','orden' =>  152],
                    ['name' => 'San Cristóbal y Nieves','orden' =>  153],
                    ['name' => 'San Marino','orden' =>  154],
                    ['name' => 'San Vicente y las Granadinas','orden' =>  155],
                    ['name' => 'Santa Lucía','orden' =>  156],
                    ['name' => 'Santo Tomé y Príncipe','orden' =>  157],
                    ['name' => 'Senegal','orden' =>  158],
                    ['name' => 'Serbia','orden' =>  159],
                    ['name' => 'Seychelles','orden' =>  160],
                    ['name' => 'Sierra Leona','orden' =>  161],
                    ['name' => 'Singapur','orden' =>  162],
                    ['name' => 'Siria','orden' =>  163],
                    ['name' => 'Somalia','orden' =>  164],
                    ['name' => 'Sri Lanka','orden' =>  165],
                    ['name' => 'Suazilandia','orden' =>  166],
                    ['name' => 'Sudán','orden' =>  167],
                    ['name' => 'Sudán del Sur','orden' =>  168],
                    ['name' => 'Suecia','orden' =>  169],
                    ['name' => 'Suiza','orden' =>  170],
                    ['name' => 'Surinam','orden' =>  171],
                    ['name' => 'Tailandia','orden' =>  172],
                    ['name' => 'Tanzania','orden' =>  173],
                    ['name' => 'Tayikistán','orden' =>  174],
                    ['name' => 'Timor Oriental','orden' =>  175],
                    ['name' => 'Togo','orden' =>  176],
                    ['name' => 'Tonga','orden' =>  177],
                    ['name' => 'Trinidad y Tobago','orden' =>  178],
                    ['name' => 'Túnez','orden' =>  179],
                    ['name' => 'Turkmenistán','orden' =>  180],
                    ['name' => 'Turquía','orden' =>  181],
                    ['name' => 'Tuvalu','orden' =>  182],
                    ['name' => 'Ucrania','orden' =>  183],
                    ['name' => 'Uganda','orden' =>  184],
                    ['name' => 'Uruguay','orden' =>  185],
                    ['name' => 'Uzbekistán','orden' =>  186],
                    ['name' => 'Vanuatu','orden' =>  187],
                    ['name' => 'Venezuela','orden' =>  188],
                    ['name' => 'Vietnam','orden' =>  189],
                    ['name' => 'Yemen','orden' =>  190],
                    ['name' => 'Yibuti','orden' =>  191],
                    ['name' => 'Zambia','orden' =>  192],
                    ['name' => 'Zimbabue','orden' =>  193]

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
