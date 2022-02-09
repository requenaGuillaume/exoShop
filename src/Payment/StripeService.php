<?php

namespace App\Payment;

use App\Cart\CartService;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class StripeService
{
    private $stripePrivateKey;    
    private $cartService;

    public function __construct(CartService $cartService, String $stripePublicKey, String $stripePrivateKey)
    {
        $this->cartService = $cartService;
        $this->stripePrivateKey = $stripePrivateKey;
        $this->stripePublicKey = $stripePublicKey;
    }


    public function getPaymentIntent(): PaymentIntent
    {
        Stripe::setApiKey($this->stripePrivateKey);

        // Create a PaymentIntent with amount and currency
        return PaymentIntent::create([
            'amount' => $this->cartService->getTotalPrice($this->cartService->getDetailsOfCart()),
            'currency' => 'eur',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);
    }


    public function getPublicKey()
    {
        return $this->stripePublicKey;
    }

}