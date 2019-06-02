@extends('layouts.main')

@section('title','Consulta por estado de pedidos')

@section('content')

<section id="constructor">
	<h1 class="text-center">
		<i class="fa fa-search" aria-hidden="true" style="color: #00b10f;"></i> Consultar pedidos
	</h1>
	<hr>

	{{ Form::open(['route'=> 'consultas.estado.search' , 'method'=>'GET', 'id'=>'formconsulta']) }}

	{{-- Consulta por estado del pedido --}}
	<div id="consulta_por_estado" class="consulta_style">
			<div class="titulo_consulta_container text-center">
				<div class="titulo_consulta"><span>Creador de consulta por estado de pedido</span></div>
			</div>

			<div class="row">
				<div class="col-sm-3 col-sm-offset-1 form-group">
					{{ Form::label('state','Estado') }}
					{{ Form::select('state',[
						'En Camino'     => 'En Camino',
						'Recibido'      => 'Recibido', 
						'Finalizado'    => 'Finalizado',
						'En Mediación'  => 'En Mediación',
						'En Disputa'    => 'En Disputa',
						'En Devolución' => 'En Devolución',
						'Reembolsado'   => 'Reembolsado'
					],null,['class'=>'form-control','placeholder'=>'Seleccionar...','required']) }}
				</div>
				
				<div class="col-sm-4 form-group">
					{{ Form::label('orden','Ordenar por') }}
					{{ Form::select('orden',['buy_date'=>'Fecha de compra','arrival_date'=>'Fecha de llegada'],'compra',['class'=>'form-control','placeholder'=>'Seleccionar...','required']) }}
				</div>

				<div class="col-sm-3 form-group">
					{{ Form::label('modo','Modo') }}
					{{ Form::select('modo',['asc'=>'Ascendente','desc'=>'Descendente'],'desc',['class'=>'form-control','placeholder'=>'Seleccionar...','required']) }}
				</div>
			</div>
	</div>
	{{-- Fin consulta por estado del pedido --}}

	<div class="row">
		<div id="div_consultar" class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4 text-center">
			{{ Form::submit('Realizar consulta',['class'=>'btn btn-primary btn-fullwidth', 'id'=>'btn_consultar', 'style'=>'margin-bottom: 30px;']) }}
		</div>		
	</div>
	{{ Form::close() }}
	
</section>

@endsection