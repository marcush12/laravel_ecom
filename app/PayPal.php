<?php

namespace App;

class PayPal
{
    private $_apiContext;
    private $shopping_cart;
    private $_ClientId = 'Af8hJk9EsuwX512rQaw4HAByZtTcZZxwFM1nLB63czWlEyVXPMbk5NsCR0_YEPgEipP_33Z6SdcHssSM';
    private $_ClientSecret = 'ELXwffXzhVXqE6YGNFxn1yjgX-pWdA-hsv9OoqZ3_T2fSf5rlP0_1Wo8Vmi5ZQrXQSDjMbASDoRkkeUi';

    public function __construct($shopping_cart)
    {
        $this->_apiContext = \PaypalPayment::ApiContext($this->_ClientId, $this->_ClientSecret);
        $config = config("paypal_payment");
        $flatConfig = array_dot($config);
        $this->_apiContext->setConfig($flatConfig);
        $this->shopping_cart = $shopping_cart;
    }
    public function generate()
    {

    }
}
