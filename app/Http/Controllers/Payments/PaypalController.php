<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Solicitudes\Solicitudes;
use App\Services\Payments\PayPalService;
use App\Models\Configuration\MasterCombos;
use App\Http\Requests\Payments\PaypalRequest;
use App\Http\Controllers\ResponseController as Response;

class PaypalController extends Controller
{
    protected $payPalService;

    public function __construct(PayPalService $payPalService)
    {
        $this->payPalService = $payPalService;
    }

    public function pay(PaypalRequest $request)
    {
        DB::beginTransaction();
        try {
            $solicitud_id = $request->input('solicitud_id');
            $solicitud = Solicitudes::setStatusSolicitud('pendiente', $solicitud_id);
            $amount = $solicitud->monto_a_pagar;
            $response = $this->payPalService->createPayment($amount);
            if ($response) {
                foreach ($response->getLinks() as $link) {
                    if ($link->getRel() == 'approval_url') {
                        session(['solicitud_id' => $solicitud_id]);
                        DB::commit();
                        return Response::sendResponseService(true, ['approval_url' => $link->getHref()]);
                    }
                }
            }
            Solicitudes::setStatusSolicitud('cancelado', $solicitud_id);
            DB::commit();
            return Response::sendResponseService(false,  ['denied_url' => url('/paypal/cancel')], 'Lo siento, no se pudo crear el pago con PayPal.');
        } catch (\Exception $ex) {
            DB::rollback();
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function execute(Request $request)
    {
        DB::beginTransaction();
        try {
            $solicitud_id = session('solicitud_id');
            $payerId = $request->get('PayerID');
            $paymentId = $request->get('paymentId');
            Solicitudes::setStatusSolicitud('en_proceso', $solicitud_id);
            $response = $this->payPalService->executePayment($paymentId, $payerId);
            if ($response) {
                DB::commit();
                return $this->success();
            }
            DB::commit();
            Solicitudes::setStatusSolicitud('cancelado', $solicitud_id);
            return redirect('/paypal/cancel');
        } catch (\Exception $ex) {
            DB::rollback();
            Log::debug($ex->getMessage());
            return Response::sendError('Ocurrio un error inesperado al intentar procesar la solicitud', 500);
        }
    }

    public function success()
    {
        return view('payments.paypal.payment_success');
    }

    public function cancel()
    {
        return view('payments.paypal.payment_cancelled');
    }
}
