<?php

namespace App\Service;

use Locale;
use Openpay\Data\Openpay;
use Openpay\Data\OpenpayApiTransactionError;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class OpenpayService
{
    private $openpay;

    public function __construct(private UrlGeneratorInterface $router, string $merchantId, string $apiKey, bool $sandboxMode = false)
    {

        Openpay::setSandboxMode($sandboxMode); // Usa `false` para el modo de producción

        $this->openpay = Openpay::getInstance($merchantId, $apiKey, 'PE', '127.0.0.1');
        $this->router = $router;
    }

    public function createCheckout(float $amount, string $currency, string $description, string $orderId, array $customerData)
    {

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'];

        /*
        $customer = [
            'name' => $customerData['name'],
            'email' => $customerData['email'],
            'phone_number' => $customerData['phone'], // Opcional
            'address' => [ // Dirección opcional
                'line1' => $customerData['address_line1'],
                'postal_code' => $customerData['postal_code'],
                'city' => $customerData['city'],
                'state' => $customerData['state'],
                'country_code' => $customerData['country_code'],
            ],
        ];

        $chargeData = [
            'amount' => $amount,
            'currency' => $currency,
            'description' => $description,
            'order_id' => $orderId,
            'method' => 'store',
            'customer' => $customer
        ];
        */

        $customer = [
            'name' => $customerData['name'],
            'email' => $customerData['email'],
            'phone_number' => $customerData['phone'], // Opcional
        ];


        //https://coesapack.com/webhook/openpay-bank-notify
        $chargeData = [
            'amount' => $amount,
            'currency' => $currency,
            'description' => $description,
            'order_id' => $orderId,
            'redirect_url' => $protocol . $domainName . $this->router->generate('app_user_profile'), //$this->router->generate('app_user_profile'),
            'customer' => $customer,
            'confirm' => false,
            'method' => 'card'
        ];

        try {
            $charge = $this->openpay->charges->create($chargeData);
        } catch (OpenpayApiTransactionError $e) {
            return ['error' => true, 'message' => $e->getMessage()];
        }

        return $charge;
    }

    public function createCharge(float $amount, string $currency, string $description, string $orderId, string $sourceId)
    {
        $chargeData = [
            'amount' => $amount,
            'currency' => $currency,
            'description' => $description,
            'order_id' => $orderId,
            'method' => 'card',
            'source_id' => $sourceId,
        ];

        return $this->openpay->charges->create($chargeData);
    }

    public function getTransaction(string $transactionId)
    {
        try {
            $charge = $this->openpay->charges->get($transactionId);
            return $charge;
        } catch (\Exception $e) {
            throw new \Exception('Error al consultar la transacción: ' . $e->getMessage());
        }
    }

    //trwuzd8skyhgxnod8gku


}
