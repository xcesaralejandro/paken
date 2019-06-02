<?php

namespace paken\Http\Controllers;

use Illuminate\Http\Request;
use paken\Http\Requests\orderProductsRequest;
use paken\Payment;
use paken\Order;
use paken\Product;

class ordersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment= Payment::orderBy('name','asc')->pluck('name','id');
        return view('create')->with('payment',$payment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(orderProductsRequest $request)
    {
        if(count($request->name)>0){
            // SET ORDER
        $order                     = new Order();
        $order->buy_date           = $request->buy_date;
        $order->arrival_date       = $request->arrival_date;
        $order->state              = $request->state;
        $order->tracking_number    = $request->tracking_number;
        $order->store              = $request->store;
        $order->seller             = $request->seller;
        $order->notes              = $request->notes;
        $order->payment_methods_id = $request->payment_methods_id;
        $order->user_id            = \Auth::user()->id;
        if ($order->save()) {
            $msj[]=array('order'=>'Se ha registrado el pedido en: ' . $order->store);
// ----------------------------------------------------------------------------------- 
        for ($i=0; $i < count($request->name); $i++) { 
            // Llenando el producto
            $product                = new Product();
            $product->name          = $request->name[$i];
            $product->brand         = $request->brand[$i];
            $product->model         = $request->model[$i];
            $product->size          = $request->size[$i];
            $product->colour        = $request->colour[$i];
            $product->material      = $request->material[$i];
            $product->url_product   = $request->url_product[$i];
            $product->unit_price    = $request->unit_price[$i];
            $product->quantity      = $request->quantity[$i];
            $product->shipping_cost = $request->shipping_cost[$i];
            $product->sku           = $request->sku[$i];
            $product->estado        = $request->estado[$i];
            $product->Order()->associate($order);
            // Guardando el producto
            if ($product->save()) {
                $msj[]=array('order'=>'Se ha registrado: ' . $product->name);
            }else{
                $msj[]=array('order'=>'No se ha podido registrar: ' . $product->name);
            }
        }

        }else{
           $msj[]=array('order'=>'El pedido ' .$order->id. ' en '.$order->store . ' No se ha podido guardar');
        }

        // Devolvemos los mensajes
        return response()->json($msj);
        }else{
            $msj[]=array('order'=>'No puede registrar un pedido sin productos asociados.');
            return response()->json($msj);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::where('user_id','=',\Auth::user()->id)->with(['products'])->find($id);
        if ($order != NULL) {
            $payment = Payment::orderBy('name','ASC')->pluck('name','id');
            return view('edit')->with('payment',$payment)
            ->with('order',$order);
        }else{
            return redirect()->route('orders.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(orderProductsRequest $request, $id)
    {
        if (count($request->name)>0) {                
            
            $order = Order::with(['products'])->find($id);
            $order->fill($request->all());
            
            if ($order->save()) {
                $msj[]=array('mensaje'=>'El pedido en '.$order->store . ' Se ha actualizado correctamente');
                for ($i=0; $i < count($request->name); $i++) { 
                    $product = Product::find($request->product_id[$i]);
                    if ($request->product_id[$i] != 0) {
                        $product->name          = $request->name[$i];
                        $product->brand         = $request->brand[$i];
                        $product->model         = $request->model[$i];
                        $product->size          = $request->size[$i];
                        $product->colour        = $request->colour[$i];
                        $product->material      = $request->material[$i];
                        $product->url_product   = $request->url_product[$i];
                        $product->unit_price    = $request->unit_price[$i];
                        $product->quantity      = $request->quantity[$i];
                        $product->shipping_cost = $request->shipping_cost[$i];
                        $product->sku           = $request->sku[$i];
                        $product->estado        = $request->estado[$i];
                        if ($product->save()) {
                            $msj[] = array('mensaje' => 'Se ha actualizado: ' . $product->name);
                        }else{
                            $msj[] = array('mensaje' => 'No se ha podido actualizar: '. $product->name);
                        }
                    }else{
                        $product = new Product();
                        $product->name          = $request->name[$i];
                        $product->brand         = $request->brand[$i];
                        $product->model         = $request->model[$i];
                        $product->size          = $request->size[$i];
                        $product->colour        = $request->colour[$i];
                        $product->material      = $request->material[$i];
                        $product->url_product   = $request->url_product[$i];
                        $product->unit_price    = $request->unit_price[$i];
                        $product->quantity      = $request->quantity[$i];
                        $product->shipping_cost = $request->shipping_cost[$i];
                        $product->sku           = $request->sku[$i];
                        $product->estado        = $request->estado[$i];
                        $product->Order()->associate($order);
                        if ($product->save()) {
                            $msj[] = array('mensaje' => 'Se ha registrado: ' . $product->name);
                        }else{
                            $msj[] = array('mensaje' => 'No se ha podido agregar: '. $product->name);
                        }
                    }
                }
            }else{
                $msj[] = array('mensaje' => 'La orden no ha podido ser actualizada.');
            }
        }else{
            $msj[] = array('mensaje' => 'La orden debe tener almenos 1 producto.');
        }
    return response()->json($msj);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::where('user_id','=',\Auth::user()->id)->find($id);
        
        if ($order != NULL) {
            if ($order->delete()) {
            return response()->json(['respuesta'=>'El pedido en '. $order->store.' se ha eliminado correctamente junto a sus productos asociados.']);
        }else{
            return response()->json(['respuesta'=>'El pedido en '. $order->store.' no ha podido ser eliminado. Posiblemente lo marcianos lo están inpidiendo... Intente más tarde']);
        }
        }else{
          return response()->json(['respuesta'=>'Usted no tiene permisos para borrar este articulo.']);  
        }
    }
}
