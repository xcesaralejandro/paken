<?php

namespace paken;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
    	'buy_date','arrival_date','state','tracking_number','store','seller','notes','user_id','payment_methods_id'
    ];

    public function user(){
    	return $this->belongsTo('paken\User','user_id','id');
    }

    public function payment(){
    	return $this->belongsTo('paken\Payment','payment_methods_id','id');
    }

    public function products(){
    	return $this->hasMany('paken\Product');
    }

    public function scopeFecha($query, $mindate, $maxdate, $orden, $modo, $filtro, $dateType){
        
        if ($dateType == 'buy_date') {
            if ($filtro == 'no') {
            return $query->where('buy_date','>=',$mindate)
                         ->where('buy_date','<=',$maxdate)
                         ->where('user_id','=',\Auth::user()->id)
                         ->orderBy($orden,$modo)->paginate(5);
            }else{
                return $query->where('buy_date','>=',$mindate)
                             ->where('buy_date','<=',$maxdate)
                             ->where('user_id','=',\Auth::user()->id)
                             ->where('state','=',$filtro)
                             ->orderBy($orden,$modo)->paginate(5);
            }
        }elseif ($dateType == 'arrival_date'){
            if ($filtro == 'no') {
            return $query->where('arrival_date','>=',$mindate)
                         ->where('arrival_date','<=',$maxdate)
                         ->where('user_id','=',\Auth::user()->id)
                         ->orderBy($orden,$modo)->paginate(5);
        }else{
            return $query->where('arrival_date','>=',$mindate)
                         ->where('arrival_date','<=',$maxdate)
                         ->where('user_id','=',\Auth::user()->id)
                         ->where('state','=',$filtro)
                         ->orderBy($orden,$modo)->paginate(5);
        }
        }
    }

    public function scopeEstado($query,$estado,$orden,$modo){
        return $query->where('state','=',$estado)
                     ->where('user_id','=',\Auth::user()->id)
                     ->orderBy($orden,$modo)->paginate(5);
    }

    public function scopeTienda($query,$nombre,$orden, $modo, $filtro){

        if ($filtro == 'no') {
            return $query->where('store',$nombre)
                         ->where('user_id','=',\Auth::user()->id)
                         ->orderBy($orden,$modo)
                         ->paginate(5);
        }else{
            return $query->where('store',$nombre)
                         ->where('state',$filtro)
                         ->where('user_id','=',\Auth::user()->id) 
                         ->orderBy($orden,$modo)
                         ->paginate(5);

        }

    }

    public function scopeVendedor($query,$nombre,$orden, $modo, $filtro){

        if ($filtro == 'no') {
            return $query->where('seller',$nombre)
                         ->where('user_id','=',\Auth::user()->id)
                         ->orderBy($orden,$modo)
                         ->paginate(5);
        }else{
            return $query->where('seller',$nombre)
                         ->where('state',$filtro)
                         ->where('user_id','=',\Auth::user()->id)
                         ->orderBy($orden,$modo)
                         ->paginate(5);

        }

    }

    public function scopeBuscar($query,$producto,$orden,$modo,$filtro){
        if ($filtro == 'no') {
            return $query->with(['products']) 
                          ->where('user_id','=',\Auth::user()->id)
                          ->whereHas('products',function($query) use ($producto){
                             $query->where('name','LIKE', "%$producto%"); 
                          })
                          ->orderBy($orden,$modo)
                          ->paginate(5);
        }else{
            return $query->with(['products']) 
                              ->where('user_id','=',\Auth::user()->id)
                              ->where('state','=',$filtro)
                              ->whereHas('products',function($query) use ($producto){
                                 $query->where('name','LIKE', "%$producto%"); 
                              })
                              ->orderBy($orden,$modo)
                              ->paginate(5);
        }

    }
    public function scopeAdvertencia($query,$fecha){
            return $query->where('state','=','En Camino')
                         ->where('arrival_date','<',$fecha)
                         ->where('user_id','=',\Auth::user()->id);
    }
}
