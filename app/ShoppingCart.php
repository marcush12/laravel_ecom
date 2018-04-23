<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $table = 'shopping_carts';
    protected $fillable = ['status']; // mass asignable fields ()

    public static function findOrCreateBySessionID($shopping_cart_id){
    	if($shopping_cart_id){
    		// find the actual SC with this
    		return ShoppingCart::findBySession($shopping_cart_id);
    	} else {
    		// create a SC
    		return ShoppingCart::createWithoutSession();
    	}
    }

    public function inShoppingCarts(){
    	return $this->hasMany('App\InShoppingCart');
    }

    public function products(){
    	return $this->belongsToMany('App\Product','in_shopping_carts'); // pivot table (2nd param)
    }

    public function order(){
        return $this->hasOne('App\Order')->first();
    }

    public static function findBySession($shopping_cart_id){
    	return ShoppingCart::find($shopping_cart_id);
    }

    public static function createWithoutSession(){

    	// old way
    	// $shopping_cart = new ShoppingCart;
    	// $shopping_cart->status = 'incompleted';
    	// $shopping_cart->save();
    	// return $shopping_cart;

    	// refactored
    	return ShoppingCart::create(['status' => 'incompleted']);

    }

    public function productsSize(){
    	//return $this->id;
    	return $this->products()->count();
    }

    public function totalBRL(){
    	return $this->products()->sum('pricing'); 	// sum all the pricing values of the shopping cart
    }

    // public function totalUSD(){
    //     return $this->products()->sum('pricing') / 100;
    // }

    public function generateCustomID(){
        return md5("$this->id $this->updated_at");
    }

    public function updateCustomIDAndStatus(){
        $this->status = 'approved';
        $this->customid = $this->generateCustomID();
        $this->save();
    }

    public function approve(){
        $this->updateCustomIDAndStatus();
    }
}
