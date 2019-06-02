@extends('layouts.main')

@section('title','Contactar con el soporte')

@section('content')
<section class="section_mainout borde_darkpurple_top">
	<h1 class="text-center ">Contactanos <i class="fa fa-heart-o heartIcons" aria-hidden="true"></i></h1>
	<hr>
	{!! Form::open(['route'=>'support.send','method'=>'POST','id'=>'contactForm']) !!}
	
	<div class="row">
		<div class="col-sm-4">
			<div class="form-group">
				{!! Form::label('asunto','Asunto') !!}
				{!! Form::text('asunto',null,['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('prioridad','Prioridad') !!}
				{!! Form::select('prioridad',['Baja'=>'Baja','Media'=>'Media','Alta'=>'Alta','Urgente'=>'Urgente'],null,['class'=>'form-control','placeholder'=>'Seleccionar...','required']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('motivo','Motivo') !!}
				{!! Form::select('motivo',['Error'=>'Reportar un error','Sugerencia'=>'Enviar una sugerencia'],null,['class'=>'form-control','placeholder'=>'Seleccionar...','required']) !!}
			</div>
		</div>

		<div class="col-sm-8">
			<div class="form-group">
				{!! Form::label('contenido_mensaje','Mensaje') !!}
				{{ Form::textarea('contenido_mensaje',null,['class'=>'form-control','rows'=>8]) }}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
			{!! Form::submit('Enviar mensaje',['class'=>'btn btn-primary text-right','style'=>'width:100%;']) !!}
		</div>
		<div class="col-sm-8">
			<div class="progress">
			  <div class="progress-bar progress-bar-primary progress-bar-striped active" role="progressbar"
			  aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:100%">
			  </div>
			</div>
			<ul id="span_msj"></ul>
		</div>
	</div>
	
	{!! Form::close() !!}

</section>
@endsection

@section('js')
<script>
	$(function(){
		$('.progress').css({'display':'none'});
		$('#contactForm').on('submit',function(e){
			$('#span_msj').html("");
			e.preventDefault();
			$.ajax({
				url: $('#contactForm').attr('action'),
				type:$('#contactForm').attr('method'),
				data:$('#contactForm').serialize(),
				'beforeSend':function(){
					$('.progress').css({'display':'block'});
				},
				'success':function(data){
					$('.progress').css({'display':'none'});
					if(data){
						$('#span_msj').html('El mensaje se ha enviado correctamente.');
						$('#span_msj').attr('style','color:green');
					}else{
						$('#span_msj').html('No se ha podido enviar el mensaje. Intentalo más tarde');
						$('#span_msj').attr('style','color:#ff3d39;');
					}
				},
				'error':function(jqXHR,error,serverError){
					$('.progress').css({'display':'none'});
					$('#span_msj').attr('style','color:#ff3d39;');
					$.each(jqXHR.responseJSON,function(indice,valor){
						$('#span_msj').append('<li>' + valor + '</li><br/>');
					});
					$('#span_msj').append('<li>' + serverError + '</li><br/>');

				}
			});
		});
	});

</script>
@endsection
