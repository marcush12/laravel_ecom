<?php

namespace App;

use App\Mail\OrderCreated;
use App\Mail\OrderUpdated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['recipient_name', 'line1','line2','city','country_code','state','postal_code','email','shopping_cart_id','status','total','guide_number'];

    public function sendMail()
    {
        //substituir email abaixo por "email" do comprador
        Mail::to("marcos012santos@gmail.com")->send(new OrderCreated($this));
    }
    public function sendUpdatedMail()
    {
        Mail::to("marcos012santos@gmail.com")->send(new OrderUpdated($this));
    }
    public function shoppingCartID()
    {
        return $this->shopping_cart->customid;
    }

    public function scopeLatest($query)
    {
        return $query->orderID()->monthly();
    }
    public function scopeOrderID($query)
    {
        return $query->orderBy("id", "desc");
    }
    public function scopeMonthly($query)
    {
        return $query->whereMonth("created_at", "=", date('m'));//date('m') dá mes atual
    }

    public function address()
    {
        return "$this->line1 $this->line2";
    }
    public function shopping_cart()
    {
        return $this->belongsTo('App\ShoppingCart');
    }
    public static function totalMonth()
    {
        return Order::monthly()->sum('total');
    }
    public static function totalMonthCount()
    {
        return Order::monthly()->count();
    }
    public static function createFromPayPalResponse($response, $shopping_cart)
    {
        $payer = $response->payer;

        $payer = $response->payer;
        $orderData = (array) $payer->payer_info->shipping_address;
        $orderData = $orderData[key($orderData)];
        $orderData['email'] = $payer->payer_info->email;
        $orderData['total'] = $shopping_cart->totalBRL();
        $orderData['shopping_cart_id'] = $shopping_cart->id;
        return Order::create($orderData);
    }
}
