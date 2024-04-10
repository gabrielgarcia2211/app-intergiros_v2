<?php

use App\Models\Solicitudes\Producto;

function mapTipoTercero($data)
{
    switch ($data['code']) {
        case 'TB':
            switch (request('servicio')) {
                case 'TP-01':
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
                case 'TP-02':
                    return [
                        'alias' => $data['usdtAliasBeneficiario'],
                        'nombre' => $data['usdtNombreBeneficiario'],
                        'tipo_documento_id' => $data['usdtTipoDocBeneficiario'],
                        'tipo_cuenta_id' => $data['usdtTipoCuentaBeneficiario'],
                        'documento' => $data['usdtDocBeneficiario'],
                        'banco' => $data['usdtBancoBeneficiario'],
                        'cuenta' => $data['usdtCuentaBeneficiario'],
                        'pago_movil' => $data['usdtMovilBeneficiario'],
                    ];
                    break;
            }
        case 'TD':
            switch (request('servicio')) {
                case 'TP-01':
                    return [
                        'alias' => $data['paypalAliasDepositante'],
                        'nombre' => $data['paypalNombreDepositante'],
                        'tipo_documento_id' => $data['paypalTipoDocumentoDepositante'],
                        'documento' => $data['paypalDocumentoDepositante'],
                        'correo' => $data['paypalCorreoDepositante'],
                        'pais_telefono_id' => $data['paypalIndicativoDepositante'],
                        'celular' => $data['paypalCelularDepositante'],
                        'pais_id' => $data['paypalPaisDepositante'],
                        'adjuntar_documento' => $data['adjuntarDocumento'],
                    ];
                    break;
                case 'TP-02':
                    return [
                        'alias' => $data['usdtAliasDepositante'],
                        'nombre' => $data['usdtNombreDepositante'],
                        'tipo_documento_id' => $data['usdtTipoDocDepositante'],
                        'documento' => $data['usdtDocDepositante'],
                        'correo' => $data['usdtEmailDepositante'],
                        'pais_telefono_id' => $data['usdtIndicativoDepositante'],
                        'celular' => $data['usdtCelularDepositante'],
                        'pais_id' => $data['usdtPaisDepositante'],
                        'adjuntar_documento' => $data['adjuntarDocumentoUsdt'],
                    ];
                    break;
            }

        case 'TAF':
            return [
                'alias' => $data['addAliasBeneficiario'],
                'nombre' => $data['addNombreBeneficiario'],
                'tipo_documento_id' => $data['addTipoDocumentoBeneficiario'],
                'documento' => $data['addDocumentoBeneficiario'],
                'banco' => $data['addBancoBeneficiario'],
                'cuenta' => $data['addCuentaBeneficiario'],
                'pago_movil' => $data['addPagoMovilBeneficiario'],
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
