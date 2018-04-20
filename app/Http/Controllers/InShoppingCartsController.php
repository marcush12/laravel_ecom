<?php

namespace App\Http\Controllers;

use App\Requests;
use App\ShoppingCart;
use App\InShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InShoppingCartsController extends Controller
{

    public function store(Request $request)
    {
        $shopping_cart_id = \Session::get('shopping_cart_id');
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);
        $response = InShoppingCart::create([
            'shopping_cart_id' => $shopping_cart->id,
            'product_id'=>$request->product_id
        ]);
        if ($response) {
            return redirect('/carrinho');
        } else {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
