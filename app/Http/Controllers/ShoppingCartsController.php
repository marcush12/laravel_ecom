<?php

namespace App\Http\Controllers;

use App\Order;
use App\PayPal;
use App\ShoppingCart;
use App\Http\Requests;
use Illuminate\Http\Request;


class ShoppingCartsController extends Controller
{
    public function __construct()
        {
          $this->middleware('shoppingcart');
        }

    public function show($id)
    {
        $shopping_cart = ShoppingCart::where('customid', $id)->first();//chave primaria usar find; outros campos usar where
        $order = $shopping_cart->order();
        return view("shopping_carts.completed", ["shopping_cart" => $shopping_cart, "order"=>$order]);
    }
    public function checkout(Request $request)
    {
        $shopping_cart = $request->shopping_cart;
        $paypal = new PayPal($shopping_cart);
        $payment = $paypal->generate();
        return redirect($payment->getApprovalLink());
    }

    public function index(Request $request)
    {
        $mailer = new OrderCreated(); //see line below
        $order = Order::all()->last();
        $order->sendUpdatedMail();
        $shopping_cart = $request->shopping_cart;
        $shopping_cart_id = \Session::get('shopping_cart_id');
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);
        $paypal = new PayPal($shopping_cart);
        $payment = $paypal->generate();
        return redirect($payment->getApprovalLink());
        $products = $shopping_cart->products()->get();
        $total = $shopping_cart->totalBRL();
        return view("shopping_carts.index", [
            'products'=> $products,
            'total'=> $total
        ]);
    }
}
