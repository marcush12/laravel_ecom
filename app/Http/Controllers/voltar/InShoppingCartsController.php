<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InShoppingCart;
use App\ShoppingCart;

class InShoppingCartsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('shoppingcart');
    }

    public function store(Request $request)
    {
        // getting the Shopping cart via middleware
         $sc = $request->shopping_cart;

         $response = InShoppingCart::create([
            'shopping_cart_id' => $sc->id,
            'product_id' => $request->product_id
         ]);

         if($request->ajax()){
            return response()->json([
                'products_count' => InShoppingCart::productsCount($sc->id)
            ]);
         }

         if($response){
            return redirect('/cart');
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
