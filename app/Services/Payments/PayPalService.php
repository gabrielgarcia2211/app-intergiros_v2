<?php

namespace App\Services\Payments;

use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\Log;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;

class PayPalService
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret')
            )
        );

        $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function createPayment($amount)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amountObj = new Amount();
        $amountObj->setCurrency('USD');
        $amountObj->setTotal($amount);

        $transaction = new Transaction();
        $transaction->setAmount($amountObj);

        $callbackUrl = url('/paypal/status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);
        try {
            $payment->create($this->apiContext);
            return $payment;
        } catch (PayPalConnectionException $e) {
            Log::debug($e->getMessage());
            return null;
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return null;
        }
    }

    public function executePayment($paymentId, $payerId)
    {
        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->apiContext);
            return $result;
        } catch (PayPalConnectionException $ex) {
            Log::debug($ex->getData());
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return null;
        }
    }
}
