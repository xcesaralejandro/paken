<?php

namespace paken\Http\Controllers;

use Illuminate\Http\Request;
use paken\Product;
use DB;
class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Construimos la consulta
        $product = DB::Table('products')
        ->join('orders','orders.id','=','products.order_id')
        ->select('products.*')
        ->where('products.id','=',$id)
        ->where('orders.user_id','=',\Auth::user()->id)
        ->get();

        // Verificamos si hay productos
        if (count($product)>0) {

        $countproduct = DB::Table('products')
        ->where('products.order_id','=',$product[0]->order_id)
        ->count();

        if ($countproduct > 1) {
            $pdxd = Product::find($id);
            if ($pdxd->delete()) {
                $msj[] = array('ok');
            }else{
                $msj[] = array('Ha ocurrido un error al intentar eliminar el producto, intentelo más tarde.');
            }
        }else{
            $msj[] = array('No puede dejar un pedido sin productos asociados, Quizá deberia editar este producto.');
        }
        
        }else{
            $msj[] = array('El producto con ID: ' . $id . 'no ha sido encontrado.');
        }
        return response()->json($msj);
    }
}
