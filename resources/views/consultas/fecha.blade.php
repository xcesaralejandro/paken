@extends('layouts.main')

@section('title','Consulta por rango de fechas')

@section('content')

<section id="constructor">
	<h1 class="text-center">
		<i class="fa fa-search" aria-hidden="true" style="color: #00b10f;"></i> Consultar pedidos
	</h1>
	<hr>

	{{ Form::open(['route'=> 'consultas.fecha.search' , 'method'=>'GET', 'id'=>'formconsulta']) }}

	{{-- Consulta por fecha --}}
	<div id="consulta_por_fecha" class="consulta_style">
			<div class="titulo_consulta_container text-center">
				<div class="titulo_consulta"><span>Creador de consulta por rango de fechas</span></div>
			</div>
		{{-- Rango de fechas --}}
		<div class="row">
			<div class="col-sm-4 col-sm-offset-2 col-lg-3 col-lg-offset-3">
				<div class="form-group">
					{{ Form::label('dateType', 'Tipo de fecha a consultar') }}
					{{ Form::select('dateType',[
						'buy_date'            => 'Fecha de compra',
						'arrival_date'        => 'Fecha de llegada',
					],null,['class'=>'form-control'])}}
				</div>
			</div>
		
			<div class="col-sm-4 col-lg-3">
				<div class="form-group">
					{{ Form::label('with_state', '¿Agregar filtro por estado?') }}
					{{ Form::select('with_state',[
						'no'            => 'No, Solo por rango de fechas',
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
		<div class="row">
			<div class="col-sm-4 col-sm-offset-2 col-lg-3 col-lg-offset-3 form-group">
				<div class="form-group">
					{{ Form::label('min','Desde') }}
					{{ Form::date('min',null,['class'=>'form-control','required']) }}
					<span id="span_min" class="text_salmon"></span>
				</div>
			</div>

			<div class="col-sm-4 col-lg-3 form-group">
				<div class="form-group">
					{{ Form::label('max','Hasta') }}
					{{ Form::date('max',null,['class'=>'form-control','required']) }}
					<span id="span_max" class="text_salmon"></span>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-4 col-sm-offset-2 col-lg-3 col-lg-offset-3 form-group">
					{{ Form::label('orden','Ordenar por') }}
					{{ Form::select('orden',['buy_date'=>'Fecha de compra','arrival_date'=>'Fecha de llegada'],'compra',['class'=>'form-control','placeholder'=>'Seleccionar...','required']) }}
				</div>

				<div class="col-sm-4 col-lg-3 form-group">
					{{ Form::label('modo','Modo') }}
					{{ Form::select('modo',['asc'=>'Ascendente','desc'=>'Descendente'],'desc',['class'=>'form-control','placeholder'=>'Seleccionar...','required']) }}
				</div>
		</div>
		{{-- Fin Rango de fechas --}}
		
	</div>
	{{-- FIN Consulta por fecha --}}

	<div class="row">
		<div id="div_consultar" class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4 text-center">
			{{ Form::submit('Realizar consulta',['class'=>'btn btn-primary btn-fullwidth', 'id'=>'btn_consultar', 'style'=>'margin-bottom: 50px;']) }}
		</div>		
	</div>
	{{ Form::close() }}
	
</section>

@endsection