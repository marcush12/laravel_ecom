<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingCart;
use App\PayPal;
use App\Order;

class PaymentsController extends Controller
{
	public function __construct() {
        $this->middleware('shoppingcart');
    }
    
    public function store(Request $request){

    	$sc = $request->shopping_cart;

		$paypal = new PayPal($sc);
		$response = $paypal->execute($request->paymentId,$request->PayerID);
		
		if($response->state == "approved"){
			\Session::remove('shopping_cart_id');
			$order = Order::createFromPayPalResponse($response,$sc);
			$sc->approve();
			
		}	

		return view('shopping_carts.completed',['shopping_cart' => $sc, 'order' => $order]);

    }
}
