<?php

use App\Models\Solicitudes\Producto;

function mapTipoTercero($data)
{
    switch ($data['code']) {
        case 'TB':
            return [
                'alias' => $data['paypalAliasBeneficiario'],
                'nombre' => $data['paypalNombreBeneficiario'],
                'tipo_documento_id' => $data['paypalTipoDocumentoBeneficiario'],
                'documento' => $data['paypalDocumentoBeneficiario'],
                'banco' => $data['paypalBancoBeneficiario'],
                'cuenta' => $data['paypalCuentaBeneficiario'],
                'pago_movil' => $data['paypalPagoMovilBeneficiario'],
            ];
            break;
        case 'TD':
            return [
                'alias' => $data['paypalAliasDepositante'],
                'nombre' => $data['paypalNombreDepositante'],
                'tipo_documento_id' => $data['paypalTipoDocumentoDepositante'],
                'documento' => $data['paypalDocumentoDepositante'],
                'correo' => $data['paypalCorreoDepositante'],
                'pais_telefono_id' => $data['paypalIndicativoDepositante'],
                'celular' => $data['paypalCelularDepositante'],
                'pais_id' => $data['paypalPaisDepositante'],
            ];
            break;
        default:
            break;
    }
}

function getCostRange($monto)
{
    $servicios = Producto::all();
    foreach ($servicios as $servicio) {
        if ($monto >= $servicio->rango_min && $monto <= $servicio->rango_max) {
            $revisiones = $monto - $servicio->costo_base;
            return [
                'id' => $servicio->id,
                'servicio' => $servicio->nombre,
                'costoBase' => $servicio->costo_base,
                'revisiones' => $revisiones
            ];
        }
    }
    // Manejar montos que exceden el rango máximo
    $ultimoServicio = $servicios->last();
    if ($monto > $ultimoServicio->rango_max) {
        return [
            'id' => $servicio->id,
            'servicio' => 'Personalizado',
            'costoBase' => $ultimoServicio->rango_max + 1,
            'revisiones' => $monto - ($ultimoServicio->rango_max + 1),
            'mensaje' => 'El monto excede los rangos estándar. Considerar servicio personalizado.'
        ];
    }
    return null;
}
