<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Cloudipsp\Configuration;
use Cloudipsp\Checkout;

class FondyService
{
    public function __construct()
    {
        require_once base_path('libs/cloudipsp/autoload.php');

        Configuration::setMerchantId(1396424);
        Configuration::setSecretKey('test');
    }

    public function createPayment($order)
    {
        $data = Checkout::url([
            'order_id' => 'order_' . $order->id . '_' . time(),
            'order_desc' => 'Оплата гаранту за заказ #' . $order->id,
            'amount' => intval($order->guarantee_amount * 100),
            'currency' => 'UAH',
            'response_url' => route('orders.confirmPayment', $order),
            'server_callback_url' => route('orders.paymentCallback', $order),
        ]);

        return $data->getUrl();
    }

    public function sendPayout($order)
    {
        $amount = round($order->guarantee_amount * 0.9, 2);
        $card = $order->guarantee_card_number;

        $data = [
            'request' => [
                'merchant_id' => 1396424,
                'order_id' => 'payout_' . $order->id . '_' . time(),
                'amount' => intval($amount * 100),
                'currency' => 'UAH',
                'card_number' => $card,
                'response_url' => route('orders.index'), // можно указать любой
                'signature' => '', // добавим ниже
            ]
        ];

        // Подпись формируется по спецификации: https://docs.fondy.eu/docs/page/3/#section-5
        $signature_str = 'test|' . $data['request']['order_id'] . '|' . $data['request']['amount'] . '|UAH|' . $card;
        $data['request']['signature'] = sha1($signature_str);

        $response = Http::post('https://api.fondy.eu/api/p2pcredit/', $data);
        Log::info('💸 Fondy payout response', $response->json());

        return $response->json();
    }
}
