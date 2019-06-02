<?php

namespace paken;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'brand','model','size','colour','material','url_product','unit_price','quantity','shipping_cost','sku','estado','order_id'
    ];

    public function Order(){
    	return $this->belongsTo('paken\Order','order_id','id');
    }
}
