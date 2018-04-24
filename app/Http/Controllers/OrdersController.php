<?php

namespace App\Http\Controllers;

use App\Order;
//use App\Http\Requests;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->get();
        $totalMonth = Order::totalMonth();
        $totalMonthCount = Order::totalMonthCount();
        return view('orders.index', ['orders'=>$orders, "totalMonth"=> $totalMonth, "totalMonthCount"=> $totalMonthCount]);
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
