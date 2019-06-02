@extends('layouts.main')

@section('title','Consulta por nombre de tienda')

@section('content')

<section id="constructor">
	<h1 class="text-center">
		<i class="fa fa-search" aria-hidden="true" style="color: #00b10f;"></i> Consultar pedidos
	</h1>
	<hr>

	{{ Form::open(['route'=> 'consultas.tienda.search' , 'method'=>'GET', 'id'=>'formconsulta']) }}

	{{-- Consulta por TIENDA --}}
	<div id="consulta_por_tienda" class="consulta_style">
		<div class="titulo_consulta_container text-center">
			<div class="titulo_consulta"><span>Creador de consulta por nombre de tienda</span></div>
		</div>

		<div class="row">
				<div class="col-sm-3 col-sm-offset-1 form-group">
					{{ Form::label('nombre_tienda','Nombre tienda') }}
					{{ Form::text('nombre_tienda',null,['class'=>'form-control','placeholder'=>'Ebay','minlength'=>'3','required']) }}
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

			<h4 class="text-center">¿Agregar filtro por estados del pedido?</h4>
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
					<div class="form-group">
						{{ Form::select('with_state',[
							'no'            => 'No, Solo por el nombre',
							'En Camino'     => 'En Camino',
							'Recibido'      => 'Recibido', 
							'Finalizado'    => 'Finalizado',
							'En Mediación'  => 'En Mediación',
							'En Disputa'    => 'En Disputa',
							'En Devolución' => 'En Devolución',
							'Reembolsado'   => 'Reembolsado'
						],null,['class'=>'form-control'])}}
					</div>
				</div>
			</div>
	</div>
	{{-- Fin consulta por TIENDA --}}


	<div class="row">
		<div id="div_consultar" class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4 text-center">
			{{ Form::submit('Realizar consulta',['class'=>'btn btn-primary btn-fullwidth', 'id'=>'btn_consultar', 'style'=>'margin-bottom: 40px;']) }}
		</div>		
	</div>
	{{ Form::close() }}
	
</section>

@endsection