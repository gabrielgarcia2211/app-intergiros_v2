<?php

namespace Database\Seeders\Configuration;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoreMasterComboEstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'parent_id' => 1,
                'name' => 'Estados de Solicitud',
                'code' => 'estados_solicitud',
                'description' => "",
                'is_father' => true,
                'status' => true,
                'childrens' => [
                    [
                        'name' => 'INICIADO',
                        'code' => 'iniciado',
                        'orden' => 0,
                        'valor1' => 'Iniciado: "¡En Marcha! Tu Solicitud ha Comenzado"',
                        'valor2' => 'Tu solicitud ha sido registrada exitosamente y ahora está en marcha. Estamos verificando los detalles iniciales y preparando todo para el siguiente paso. Mantente atento a futuras actualizaciones y no dudes en consultar el estado de tu solicitud en nuestro sistema en cualquier momento',
                    ],
                    [
                        'name' => 'PENDIENTE BENEFICIARIO',
                        'code' => 'pendiente_beneficiario',
                        'orden' => 1,
                        'valor1' => '¡Ups! · Algo ha ocurrido con tu solicitud',
                        'valor2' => 'Gracias por utilizar nuestro servicio. Te estaremos informando cuando tu pago haya sido verificado y tu pedido pase a cola de transferencia.',
                    ],
                    [
                        'name' => 'PENDIENTE DEPOSITANTE',
                        'code' => 'pendiente_depositante',
                        'orden' => 2,
                        'valor1' => '¡Ups! · Algo ha ocurrido con tu solicitud',
                        'valor2' => 'Gracias por utilizar nuestro servicio. Te estaremos informando cuando tu pago haya sido verificado y tu pedido pase a cola de transferencia.',
                    ],
                    [
                        'name' => 'PENDIENTE MONTO',
                        'code' => 'pendiente_monto',
                        'orden' => 3,
                        'valor1' => '¡Ups! · Algo ha ocurrido con tu solicitud',
                        'valor2' => 'Gracias por utilizar nuestro servicio. Te estaremos informando cuando tu pago haya sido verificado y tu pedido pase a cola de transferencia.',
                    ],
                    [
                        'name' => 'EN PROCESO',
                        'code' => 'en_proceso',
                        'orden' => 4,
                        'valor1' => '¡Enhorabuena! · Hemos recibido tu pedido',
                        'valor2' => '¡Buenas noticias! Tu solicitud está activamente siendo procesada. Estamos en la fase de ejecución y trabajando arduamente para completarla. Puedes seguir el progreso en tiempo real en tu panel de usuario.',
                    ],
                    [
                        'name' => 'ENTREGADO',
                        'code' => 'entregado',
                        'orden' => 5,
                        'valor1' => '¡Finalmente! · Tu pedido ha sido procesado',
                        'valor2' => 'Pulsa sobre esta notificación para acceder al historial de envíos y obtener el comprobante o búscalo directamente en el correo electrónico enviado en notificación.',
                    ],
                    [
                        'name' => 'CANCELADO',
                        'code' => 'cancelado',
                        'orden' => 6,
                        'valor1' => 'Tu solicitud ha sido rechazada',
                        'valor2' => 'Pulsa sobre esta notificación para acceder al historial de envíos y conocer el motivo del rechazo.',
                    ],
                    [
                        'name' => 'REEMBOLSADO',
                        'code' => 'reembolsado',
                        'orden' => 6,
                        'valor1' => 'El pago de tu solicitud ha sido reembolsado',
                        'valor2' => 'Pulsa sobre esta notificación para acceder al historial de envíos y obtener el comprobante.',
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
                        'code' => $child['code'],
                        'valor1' => $child['valor1'],
                        'valor2' => $child['valor2'],
                        'orden' => $child['orden'],
                        'status' => true
                    ]);
                }
            }
        }
    }
}
