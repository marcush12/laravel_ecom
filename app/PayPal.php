<?php

namespace App;

use Anouar\Paypalpayment\Facades\PaypalPayment;

class PayPal
{
    private $_apiContext;
    private $shopping_cart;
    private $_ClientId = 'Af8hJk9EsuwX512rQaw4HAByZtTcZZxwFM1nLB63czWlEyVXPMbk5NsCR0_YEPgEipP_33Z6SdcHssSM';
    private $_ClientSecret = 'ELXwffXzhVXqE6YGNFxn1yjgX-pWdA-hsv9OoqZ3_T2fSf5rlP0_1Wo8Vmi5ZQrXQSDjMbASDoRkkeUi';

    public function __construct($shopping_cart) {

        // //call the paypal config
        $this->_apiContext = \PaypalPayment::ApiContext(config('paypal_payment.Account.ClientId'), config('paypal_payment.Account.ClientSecret'));
        // // call the config using the new file (config directory)
        $config = config("paypal_payment");
        // // transform - into plain array
        $flatConfig = array_dot($config);

        $this->_apiContext->setConfig($flatConfig);

        // //receive the SCart
        $this->shopping_cart = $shopping_cart;
    }

    public function generate(){
        $payment = \PaypalPayment::payment()->setIntent("sale")
        ->setPayer($this->payer())
        ->setTransactions([$this->transaction()])
        ->setRedirectUrls($this->redirectURLs());

        try {
            $payment->create($this->_apiContext);
        } catch (\Exception $e) {
            dd($e);
            exit(1);
        }

        return $payment;
    }

    public function payer(){
        //return payments info
        return \PaypalPayment::payer()->setPaymentMethod('paypal');
    }

    public function redirectUrls(){
        $baseURL = url('/');
        return \PaypalPayment::redirectURLs()->setReturnUrl("$baseURL/payments/store")
            ->setCancelUrl("$baseURL/cart");
    }


    public function transaction(){
        // return transaction info
        return \PaypalPayment::transaction()
            ->setAmount($this->amount())
            ->setItemList($this->items())
            ->setDescription('Your Products on Davids Store')
            ->setInvoiceNumber(uniqid());
    }

    public function items(){
        $items = [];
        $products = $this->shopping_cart->products()->get();
        foreach($products as $product){
            array_push($items, $product->paypalItem());
        }

        return \PaypalPayment::itemList()->setItems($items);
    }

    public function amount(){
        return \PaypalPayment::amount()->setCurrency('BRL')
            ->setTotal($this->shopping_cart->totalBRL());
    }

    public function execute($paymentId, $payerId) {
        $payment = \PaypalPayment::getById($paymentId, $this->_apiContext);
        $execution = \PaypalPayment::PaymentExecution()->setPayerId($payerId);
        return $payment->execute($execution, $this->_apiContext);
    }

}
