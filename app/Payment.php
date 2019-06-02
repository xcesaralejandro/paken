<?php

namespace paken;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	protected $table    = 'payment_methods';
	
	protected $fillable = ['name'];

    public function orders(){
    	return $this->hasMany('paken\Order');
    }
}
