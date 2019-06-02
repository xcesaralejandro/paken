<?php
namespace paken\Http\ViewComposer;
use Illuminate\View\View;
use paken\Order;
use paken\Product;
use paken\Payment;

class OrderAll {
	public function compose(View $view){
		$order       = Order::with(['products','payment'])->where('user_id',\Auth::user()->id)->orderBy('buy_date','DESC')->paginate(5);
		
		$total       = Order::all()
					   ->where('user_id',\Auth::user()->id)->count();
		
		$encamino    = Order::where('user_id',\Auth::user()->id)
					   ->where('state','En Camino')->count();
		
		$recibidos   = Order::where('user_id',\Auth::user()->id)
					   ->where('state','Recibido')->count();
		
		$finalizados = Order::where('user_id',\Auth::user()->id)
							   ->where('state','Finalizado')->count();
		
		$devolucion  = Order::where('user_id',\Auth::user()->id)
							   ->where('state','En Devolución')->count();
		
		$mediacion   = Order::where('user_id',\Auth::user()->id)
							   ->where('state','En Mediación')->count();
		
		$disputa     = Order::where('user_id',\Auth::user()->id)
							   ->where('state','En Disputa')->count();
		
		$reembolsado = Order::where('user_id',\Auth::user()->id)
							   ->where('state','Reembolsado')->count();
		
		$advertencias = Order::Advertencia(date('Y-m-d'))->count();
		$view->with('order',$order)
		->with('total', $total)
		->with('camino',$encamino)
		->with('recibidos',$recibidos)
		->with('finalizados',$finalizados)
		->with('devolucion',$devolucion)
		->with('mediacion',$mediacion)
		->with('disputa',$disputa)
		->with('reembolsado',$reembolsado)
		->with('advertencias',$advertencias);
	}
}