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
                        'name' => 'PENDIENTE',
                        'code' => 'pendiente',
                        'orden' => 1,
                        'valor1' => 'Pendiente: "En Espera: Tu Solicitud está siendo Revisada"',
                        'valor2' => 'Tu solicitud ahora está en estado de espera, pendiente de revisión. Nuestro equipo está trabajando para evaluarla y procesarla lo más rápido posible. Puede que te contactemos si necesitamos información adicional. Gracias por tu paciencia.',
                    ],
                    [
                        'name' => 'EN PROCESO',
                        'code' => 'en_proceso',
                        'orden' => 2,
                        'valor1' => 'En Proceso: "¡En Acción! Tu Solicitud está en Proceso"',
                        'valor2' => '¡Buenas noticias! Tu solicitud está activamente siendo procesada. Estamos en la fase de ejecución y trabajando arduamente para completarla. Puedes seguir el progreso en tiempo real en tu panel de usuario.',
                    ],
                    [
                        'name' => 'ENTREGADO',
                        'code' => 'entregado',
                        'orden' => 3,
                        'valor1' => 'Entregado: "¡Listo! Tu Solicitud ha sido Completada"',
                        'valor2' => '¡Finalmente! Tu solicitud ha sido procesada y completada con éxito. Puedes acceder al panel de resultados para obtener más detalles o buscar en tu correo electrónico la notificación con toda la información relevante. ¡Gracias por confiar en nosotros!',
                    ],
                    [
                        'name' => 'CANCELADO',
                        'code' => 'cancelado',
                        'orden' => 4,
                        'valor1' => 'Cancelado: "Aviso Importante: Tu Solicitud ha sido Cancelada"',
                        'valor2' => 'Lamentamos informarte que tu solicitud ha sido cancelada. Para más detalles sobre las razones de esta decisión y posibles pasos a seguir, por favor consulta el panel de usuario o ponte en contacto con nuestro equipo de soporte. Estamos aquí para ayudarte.',
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
