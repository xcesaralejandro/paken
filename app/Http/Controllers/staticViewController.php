<?php

namespace paken\Http\Controllers;

use Illuminate\Http\Request;
use paken\Http\Requests\supportSendRequest;
use paken\Order;
use paken\Product;
use DB;
class staticViewController extends Controller
{
    public function soporte(){
        return View('staticview.support');
    }
// PAGINA PRINCIPAL USUARIOS REGISTRADOS
    public function inicioPrivate(){
        $totalPedidos     = Order::all()->where('user_id',\Auth::user()->id)->count();
        $totalProductos   = DB::table('orders')
                            ->join('products','products.order_id','=','orders.id')
                            ->select('products.*')
                            ->where('orders.user_id','=',\Auth::user()->id)
                            ->count();
        $totalEncamino    = Order::where('state','En camino')->where('user_id',\Auth::user()->id)->count();
        $totalReembolsado = Order::where('state','Reembolsado')->where('user_id',\Auth::user()->id)->count();
        $totalFinalizado  = Order::where('state','Finalizado')->where('user_id',\Auth::user()->id)->count();
        $totalAdvertencia = Order::Advertencia(date('Y-m-d'))->count();
        $totalTiendas     = Order::all()->where('user_id',\Auth::user()->id)->groupBy('store')->count();
        $totalVendedores  = Order::all()->where('user_id',\Auth::user()->id)->groupBy('seller')->count();
        $arrayDatos = array('pedidos'     => $totalPedidos, 
                            'productos'   => $totalProductos,
                            'encamino'    => $totalEncamino,
                            'reembolsado' => $totalReembolsado,
                            'finalizado'  => $totalFinalizado,
                            'advertencia' => $totalAdvertencia,
                            'tiendas'     => $totalTiendas,
                            'vendedores'  =>$totalVendedores
                        );
    	return View('staticview.inicio')
               ->with('datos', $arrayDatos);
    }
// FIN PAGINA PRINCIPAL USUARIOS REGISTRADOS



// PAGINA DE CONTACTO
    public function supportSend(supportSendRequest $request){
    	if (mail('cesar.mcid@gmail.com',"[$request->prioridad] - " . $request->asunto,
    			"Este mensaje ha sido generado desde paken." .
    			"Asunto: $request->asunto" . "\n" .
				"Prioridad: $request->prioridad" . "\n" .
				"Motivo: $request->motivo" . "\n" .
				"Mensaje:" . "\n" ."$request->contenido_mensaje" 
    		)) {
    		return response()->json(true);
    	}else{
    		return response()->json(false);
    	}
    }
// FIN PAGINA DE CONTACTO
}
