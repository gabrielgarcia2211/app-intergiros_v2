<?php

use App\Models\Solicitudes\Producto;

function mapTipoTercero($data)
{
    switch ($data['code']) {
        case 'TB':
            switch ($data['servicio']) {
                case 'TP-01':
                case 'TP-02':
                case 'TP-03':
                case 'TP-04':
                case 'TP-05':
                case 'TP-06':
                    return [
                        'alias' => $data['aliasBeneficiario'],
                        'nombre' => $data['nombreBeneficiario'],
                        'tipo_documento_id' => $data['tipoDocumentoBeneficiario'],
                        'documento' => $data['documentoBeneficiario'],
                        'banco_id' => $data['bancoBeneficiario'],
                        'cuenta' => $data['cuentaBeneficiario'],
                        'pago_movil' => $data['pagoMovilBeneficiario'] ?? null,
                        'tipo_cuenta_id' => $data['tipoCuentaBeneficiario'],
                    ];
                    break;
            }
        case 'TD':
            switch (request('servicio')) {
                case 'TP-01':
                case 'TP-02':
                case 'TP-03':
                    return [
                        'alias' => $data['aliasDepositante'],
                        'nombre' => $data['nombreDepositante'],
                        'tipo_documento_id' => $data['tipoDocumentoDepositante'],
                        'documento' => $data['documentoDepositante'],
                        'correo' => $data['correoDepositante'],
                        'pais_telefono_id' => $data['codigoIDepositante'],
                        'celular' => $data['celularDepositante'],
                        'pais_id' => $data['paisDepositante'],
                        'adjuntar_documento' => $data['adjuntarDocumento']
                    ];
                    break;
                case 'TP-04':
                case 'TP-05':
                    return [
                        'alias' => $data['aliasDepositante'],
                        'nombre' => $data['nombreDepositante'],
                        'tipo_documento_id' => $data['tipoDocumentoDepositante'],
                        'documento' => $data['documentoDepositante'],
                        'banco_id' => $data['bancoDepositante'],
                        'tipo_cuenta_id' => $data['tipoCuentaDepositante'],
                        'cuenta' => $data['cuentaDepositante'],
                        'pais_telefono_id' => $data['codigoIDepositante'],
                        'celular' => $data['celularDepositante'],
                        'adjuntar_documento' => $data['adjuntarDocumento']
                    ];
                    break;
                case 'TP-06':
                    return [
                        'alias' => $data['aliasDepositante'],
                        'nombre' => $data['nombreDepositante'],
                        'tipo_documento_id' => $data['tipoDocumentoDepositante'],
                        'documento' => $data['documentoDepositante'],
                        'banco_id' => $data['bancoDepositante'],
                        'tipo_cuenta_id' => $data['tipoCuentaDepositante'],
                        'cuenta' => $data['cuentaDepositante'],
                        'adjuntar_documento' => $data['adjuntarDocumento']
                    ];
                    break;
            }
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

function renderDataTable($query, $request, $with = [], $select = false)
{
    # Ordenamiento
    if ($request->has('sort') && !empty($request->input('sort')) && !empty($request->input('sort')[0])) {
        $sort = $request->input('sort');
        $field = $sort[0];
        $type = $sort[1];
        $query->orderBy($field, ($type == 1) ? 'desc' : 'asc');
    }

    # Filtros
    if ($request->has('filters') && !empty($request->input('filters'))) {
        $filters = $request->input('filters');
        for ($i = 0; $i < count($filters); $i++) {
            $operator = getSqlOperator($filters[$i][1]);
            $value = getQueryValue($filters[$i][1], $filters[$i][2]);
            $query->where($filters[$i][0], $operator, $value);
        }
    }

    # Condicionales
    if ($request->has('conditions') && !empty($request->input('conditions'))) {
        $conditions = $request->input('conditions');
        foreach ($conditions as $column => $value) {
            $query->where($column, $value);
        }
    }

    //Log::debug($query->toSql());
    $perPage = $request->input('perPage');
    return $query->with($with)->select($select)->paginate($perPage);
}

function getSqlOperator($operator)
{
    switch ($operator) {
        case 'contains':
            return 'LIKE';
        case 'notContains':
            return 'NOT LIKE';
        case 'startsWith':
            return 'LIKE';
        case 'endsWith':
            return 'LIKE';
        case 'equals':
            return 'LIKE';
        case 'notEquals':
            return '<>';
        default:
            return null;
    }
}

function getQueryValue($operator, $value)
{
    switch ($operator) {
        case 'contains':
            return '%' . $value . '%';
        case 'notContains':
            return '%' . $value . '%';
        case 'startsWith':
            return $value . '%';
        case 'endsWith':
            return '%' . $value;
        case 'equals':
            return '%' . $value . '%';
        default:
            return $value;
    }
}

function generateCodReferencia($user_id)
{
    $timestamp = time();
    $random_value = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 3);
    $identificador_unico = $user_id . $timestamp . $random_value;
    return $identificador_unico;
}

function clearText($texto)
{
    $palabras_a_eliminar = array("cop", "dólar", "soles", "bs", "$");
    $texto_limpio = str_replace($palabras_a_eliminar, "", $texto);
    $texto_limpio = preg_replace('/\s+/', '', $texto_limpio);
    $numero_formateado = str_replace(',', '.', str_replace('.', '', $texto_limpio));
    return $numero_formateado;
}
