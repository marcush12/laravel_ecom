<?php

namespace App\Http\Controllers;

use App\ShoppingCart;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function home()
    {

        return view('main.home');
    }
}
