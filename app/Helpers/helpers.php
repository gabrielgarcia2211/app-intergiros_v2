<?php

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
