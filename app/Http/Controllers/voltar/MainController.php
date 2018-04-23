<?php

namespace App\Http\Controllers;

use App\Product;
use App\ShoppingCart;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function home()
    {
        $products = Product::latest()->simplePaginate(2);
        return view('main.home', ["products"=>$products]);
    }
}
