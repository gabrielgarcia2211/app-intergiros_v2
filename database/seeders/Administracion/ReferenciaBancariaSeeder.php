<?php

namespace Database\Seeders\Administracion;

use Illuminate\Database\Seeder;
use App\Models\Administracion\TipoMoneda;
use App\Models\Administracion\ReferenciaBancaria;

class ReferenciaBancariaSeeder extends Seeder
{
    public function run()
    {

        $referencias = [
            [
                'pais' => 'Peru',
                'codigo' => 'PEN',
                'banco' => 'BCP',
                'titular' => 'Brandy Mejía',
                'tipo' => 'Cuenta ahorros en soles',
                'numero' => '19172416115089',
            ],
            [
                'pais' => 'Peru',
                'codigo' => 'PEN',
                'banco' => 'BBVA Continental',
                'titular' => 'Ronald Moreno',
                'tipo' => 'Cuenta ahorros en soles',
                'numero' => '001101170201274601',
            ],
            [
                'pais' => 'Peru',
                'codigo' => 'PEN',
                'banco' => 'INTERBANK',
                'titular' => 'INTERCOMMERCE SOLUTIONS E.I.R.L.',
                'tipo' => 'Cuenta corriente en soles',
                'numero' => '2003005249420',
            ],
            [
                'pais' => 'EEUU',
                'codigo' => 'USD',
                'banco' => 'BCP',
                'titular' => 'Brandy Mejía',
                'tipo' => 'Cuenta ahorros en dólares',
                'numero' => '19170237030193',
            ],
            [
                'pais' => 'EEUU',
                'codigo' => 'USD',
                'banco' => 'BBVA Continental',
                'titular' => 'Ronald Moreno',
                'tipo' => 'Cuenta ahorros en dólares',
                'numero' => '001101170201274628',
            ],
            [
                'pais' => 'EEUU',
                'codigo' => 'USD',
                'banco' => 'INTERBANK',
                'titular' => 'INTERCOMMERCE SOLUTIONS E.I.R.L.',
                'tipo' => 'Cuenta corriente en dólares',
                'numero' => '2003005249438',
            ],
            [
                'pais' => 'Venezuela',
                'codigo' => 'VES',
                'banco' => 'Banco de Venezuela',
                'titular' => 'Guillermina Cruz',
                'tipo' => 'Cuenta corriente',
                'numero' => '01020399610000357229',
            ],
            [
                'pais' => 'Venezuela',
                'codigo' => 'VES',
                'banco' => 'Banco de Venezuela',
                'titular' => 'Guillermina Cruz',
                'tipo' => 'Pago móvil',
                'numero' => '04144533159',
            ],
            [
                'pais' => 'Colombia',
                'codigo' => 'COP',
                'banco' => 'Banco de Bogotá',
                'titular' => 'Yancy Moncada',
                'tipo' => 'Cuenta ahorros',
                'numero' => '303474076',
            ],
            [
                'pais' => 'Colombia',
                'codigo' => 'COP',
                'banco' => 'Bancolombia',
                'titular' => 'Yancy Moncada',
                'tipo' => 'Cuenta ahorros',
                'numero' => '08800003106',
            ],
            [
                'pais' => 'Colombia',
                'codigo' => 'COP',
                'banco' => 'Nequi',
                'titular' => 'Luis Mejía',
                'tipo' => 'Cuenta nequi',
                'numero' => '3112965156',
            ],
            [
                'banco' => 'USDT',
                'especial' => 1,
                'otros' => [
                    'numero' => 'TN3ZieDQjBLLnJ2Njk1n95w8SdiHrjCMya',
                    'banco' => 'Binance Pay',
                    'id' => '222065054',
                ]
            ],
            [
                'banco' => 'Zinli',
                'especial' => 1,
                'otros' => [
                    'correo' => 'natashacasanovad@gmail.com',
                ]
            ],
        ];

        foreach ($referencias as $key => $value) {
            if (isset($value['codigo'])) {
                $tipoMoneda = TipoMoneda::where('codigo', $value['codigo'])->first();
                ReferenciaBancaria::create([
                    'pais' => $value['pais'],
                    'banco' => $value['banco'],
                    'titular' => $value['titular'],
                    'tipo' => $value['tipo'],
                    'numero' => $value['numero'],
                    'especial' => 0,
                    'otros' => null,
                    'tipo_moneda_id' => $tipoMoneda->id,
                ]);
            } else if (isset($value['especial']) && $value['especial'] == 1) {
                ReferenciaBancaria::create([
                    'banco' => $value['banco'],
                    'especial' => 1,
                    'otros' => json_encode($value['otros']),
                    'tipo_moneda_id' => null,
                ]);
            }
        }
    }
}
