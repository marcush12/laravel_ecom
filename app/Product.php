<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $table = 'products';

    public function paypalItem(){
    	return \PaypalPayment::item()->setName($this->title)
    	->setDescription($this->description)
    	->setCurrency('USD')
    	->setQuantity(1)
    	->setPrice($this->pricing / 100);
    }

    public function scopeLatest($query){
    	return $query->orderBy('id','desc'); 
    }
}
