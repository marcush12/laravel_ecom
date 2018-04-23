<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\ShoppingCart;
use App\PayPal;
use App\Order;


class ShoppingCartsController extends Controller
{
    public function __construct(){
        $this->middleware('shoppingcart');
    }

    public function index(Request $request){

        $sc = $request->shopping_cart;

		$products = $sc->products()->get();
		$total = $sc->total();
		return view('shopping_carts.index', ['products' => $products, 'total' => $total]);
    }

    public function show($id){
    	$sc = ShoppingCart::where('customid',$id)->first();
    	$order = $sc->order();
    	return view('shopping_carts.completed',['shopping_cart' => $sc, 'order' => $order]);
    }

    public function checkout(Request $request){

        $sc = $request->shopping_cart;
        $paypal = new PayPal($sc);
        $payment = $paypal->generate();
        return redirect($payment->getApprovalLink());
    }
}
