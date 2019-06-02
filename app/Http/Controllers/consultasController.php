<?php

namespace paken\Http\Controllers;

use Illuminate\Http\Request;
use paken\Order;

class consultasController extends Controller
{
    // Devolvemos las vistas para cada consulta
    public function indexfecha()
    {
        return view('consultas.fecha');
    }

    public function indexestado()
    {
        return view('consultas.estado');
    }

    public function indextienda()
    {
        return view('consultas.tienda');
    }

    public function indexvendedor()
    {
        return view('consultas.vendedor');
    }

    public function indexproducto()
    {
        return view('consultas.producto');
    }

    // Procesamos todas las consultas

    public function searchfecha (Request $request){
        $this->validate($request,[
                'min'        => 'date|required',
                'max'        => 'date|required',
                'orden'      => 'string|required',
                'dateType'   => 'required|string',
                'modo'       => 'min:3|max:4|string|required',
                'with_state' => 'string|required'
            ]);
        $consulta = Order::Fecha($request->min, $request->max, $request->orden, $request->modo, $request->with_state, $request->dateType);
        return view('resultadoConsulta')->with('order',$consulta);
    }

    public function searchestado (Request $request){
        $this->validate($request,[
                'state' => 'string|min:3|required',
                'orden' => 'string|required',
                'modo'  => 'min:3|max:4|string|required',
            ]);
        $consulta = Order::Estado($request->state, $request->orden, $request->modo);
        return view('resultadoConsulta')->with('order', $consulta);
    }

    public function searchproducto (Request $request){
        $this->validate($request,[
                'producto'   => 'required',
                'orden'      => 'string|required',
                'modo'       => 'min:3|max:4|string|required',
                'with_state' => 'string|required'
            ]);
        $consulta = Order::Buscar($request->producto, $request->orden, $request->modo, $request->with_state);     
        return view('resultadoConsulta')->with('order',$consulta);
    }

    public function searchtienda (Request $request){
        $this->validate($request,[
                'nombre_tienda' => 'required',
                'orden'         => 'string|required',
                'modo'          => 'min:3|max:4|string|required',
                'with_state'    => 'string|required'
            ]);
        $consulta = Order::Tienda($request->nombre_tienda, $request->orden, $request->modo, $request->with_state);
        return view('resultadoConsulta')->with('order',$consulta);
    }

    public function searchvendedor (Request $request){
        $this->validate($request,[
                'vendedor'   => 'required',
                'orden'      => 'string|required',
                'modo'       => 'min:3|max:4|string|required',
                'with_state' => 'string|required'
            ]);
        $consulta = Order::Vendedor($request->vendedor, $request->orden, $request->modo, $request->with_state);
        return view('resultadoConsulta')->with('order',$consulta);
    }


    public function searchExpirado(){
        $fecha_inicio = explode(" ",\Auth::user()->created_at);
        $consulta = Order::Fecha($fecha_inicio[0], date('Y-m-d'), 'arrival_date', 'desc','En Camino', 'arrival_date');
        return view('resultadoConsulta')->with('order',$consulta);
    }
}
