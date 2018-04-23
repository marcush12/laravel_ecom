<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::latest()->get();
        $totalMonth = Order::totalMonth();
        $totalMonthCount = Order::totalMonthCount();
        return view('orders.index',['orders' => $orders,
                'totalMonth' => $totalMonth,
                'totalMonthCount' => $totalMonthCount]);
    }


    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $field = $request->name;
        $order->$field = $request->value;
        $order->save();
        return $order->$field;
    }

}
