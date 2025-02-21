<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use TsaiYiHua\ECPay\Checkout;

class CheckoutController extends Controller
{
    protected $checkout;

    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }

    public function sendOrder()
    {
        $formData = [
            'UserId' => 1, // 用戶ID , Optional
            'ItemDescription' => '好好玩',
            'ItemName' => '大阪一日遊',
            'TotalAmount' => '20000',
            'PaymentMethod' => 'ALL', // ALL, Credit, ATM, WebATM
        ];
        return $this->checkout->setPostData($formData)->send();
    }
}
