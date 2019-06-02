@extends('layouts.main')

@section('title','Agregar un nuevo pedido')

@section('content')
	{{-- FORMULARIO DE PRODUCTS --}}
	<div>
	<h2 class="text-center"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
 Productos</h2>
	<button type="button" class="btn btn-primary btn-sm" id="btn_product" style="float: right !important; position: relative; top:-6px;">
	<i class="fa fa-plus" aria-hidden="true"></i> Agregar producto</button>
	</div>
	<hr>


	{{-- FORMULARIO DE PRODUCTOS --}}
	{!! Form::open(['route'=>'orders.store','method'=>'POST','id'=>'mainform']) !!}
	<div class="container_product">
	<div class="full_product" id="full_product">
	<div class="resumen_info paleta_2">	
		<div class="row">
			<div class="col-xs-10">
				Nuevo <strong>producto</strong>
			</div>

			<div id="newcolora" class="col-xs-2 text-right" style="padding-right: 20px;">
				<a class="close_form" id="close_form" href="Notfound" target="__blank"><i class="fa fa-times" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
	<div class="product" id="pdto">
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('name','Nombre') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Nombre del producto."></i>
				{!! Form::text('name[]',null,['class'=>'form-control','placeholder'=>'Jeans Modernos hombre 2017','required']) !!}
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('brand','Marca') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Marca del producto."></i>
				{!! Form::text('brand[]',null,['class'=>'form-control','placeholder'=>'Foster']) !!}
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('model','Modelo') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Modelo del producto."></i>
				{!! Form::text('model[]',null,['class'=>'form-control','placeholder'=>'Skinny fit']) !!}
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('size','Talla / Tamaño') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Valor del tamaño o talla de tu producto Ej: ROPA: M,L,XL; PERFUMES: 50ml,100ml, 200ml;"></i>
				{!! Form::text('size[]',null,['class'=>'form-control','placeholder'=>'46']) !!}
			</div>
		</div>

	</div>

	<div class="row">	
		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('colour','Color') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Si eres daltonico procura consultar el color en la descripción."></i>
				{!! Form::text('colour[]',null,['class'=>'form-control', 'placeholder'=>'Navy']) !!}
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('material','Material del producto') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Algodón, poliester, plastico, madera, etc."></i>
				{!! Form::text('material[]',null,['class'=>'form-control', 'placeholder'=>'Algodón y poliester']) !!}
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('estado','Estado del producto') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Esto es a prueba de tontos, sin ofender a nadie :) ."></i>
				{!! Form::select('estado[]',['new'=>'Nuevo', 'used' => 'usado'],'new',['class'=>'form-control estado', 'placeholder'=>'Seleccionar...']) !!}
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('quantity','Cantidad de productos') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Cantidad total de articulos que compartan toda su descripción"></i>
				{!! Form::number('quantity[]',1,['class'=>'form-control quantity','step'=>'1','min'=>'1','placeholder'=>'5']) !!}
			</div>
		</div>


</div>{{-- .row  --}}

<div class="row">	
		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('unit_price','Valor unitario') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="El campo acepta dos decimales, por lo cual puedes escribir el precio en dolares o ignorar los decimales para trabajar el valor como CLP u otra divisa."></i>
				{!! Form::number('unit_price[]',0,['class'=>'form-control unit_price','step'=>'0.01','min'=>'0','placeholder'=>'38.60']) !!}
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('shipping_cost','Costo de envío') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Si el producto dispone de envío internacional gratuito deja este campo en 0."></i>
				{!! Form::number('shipping_cost[]',0,['class'=>'form-control shipping_cost','step'=>'0.01','min'=>'0','placeholder'=>'3.25']) !!}
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('sku','SKU') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="El SKU es el codigo identificador de un producto."></i>
				{!! Form::text('sku[]',null,['class'=>'form-control','placeholder'=>'123456789','step'=>'1','min'=>'0']) !!}
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('url_product','URL Producto') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Guardar la url del producto es util por si luego quieres ver la publicación nuevamente."></i>
				{!! Form::text('url_product[]',null,['class'=>'form-control','placeholder'=>'http://www.ebay.com/itm/like...']) !!}
			</div>
		</div>

</div>{{-- .row  --}}
</div>{{-- .product  --}}
</div>{{-- .container_product  --}}
</div>{{-- .full_product  --}}

	{{-- FORMULARIO DE ORDERS --}}
	<h2 class="text-center" style="margin-top:50px;"><i class="fa fa-file-text-o" aria-hidden="true"></i>
 Detalles del pedido</h2>
	<hr>
	<div class="resumen_info paleta_3">
		Nuevo <strong>pedido</strong>
	</div>
	<div class="product">
	<div class="row">
		<div class="col-md-3">
			
			<div class="form-group">
				{!! Form::label('buy_date','Fecha del pedido') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Fecha cuando realisaste la compra."></i>
				{!! Form::date('buy_date',date('Y-m-d'),['class'=>'form-control','placeholder'=>'2017-12-30','required']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('arrival_date','Fecha de llegada') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Si te entregan un rango de fechas para la llegada de tu compra registra la fecha más lejana ya que así sabrás cuando pasó la fecha limite entregada por el vendedor."></i>
				{!! Form::date('arrival_date',null,['class'=>'form-control','placeholder'=>'2017-12-30','required']) !!}
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('state','Estado del pedido') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Recuerda cambiar esta opción de acuerdo al estado de tu compra posteriormente."></i>
				{!! Form::select('state',['En Camino'=>'En Camino'],null,['class'=>'form-control','required']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('tracking_number','Numero de seguimiento') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="A veces el numero de seguimiento lo dan dias despues de la compra, puedes dejar este campo en blanco y actualizarlo más tarde."></i>
				{!! Form::text('tracking_number',null,['class'=>'form-control','placeholder'=>'RN123456789CN']) !!}
			</div>
		</div>

		<div class="col-md-3">

			<div class="form-group">
				{!! Form::label('store','Tienda') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Nombre de la tienda donde compraste."></i>
				{!! Form::text('store',null, ['class'=>'form-control','placeholder'=>'Ebay','required']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('seller','Vendedor') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Nombre de usuario del vendedor con el cual se encuentra registrado en la tienda."></i>
				{!! Form::text('seller',null, ['class'=>'form-control','placeholder'=>'Good_seller_2011']) !!}
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('payment_methods_id','Medio de pago') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="El medio por el cual pagaste."></i>
				{!! Form::select('payment_methods_id',$payment,1,['class'=>'form-control chosen-select','required']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('notes','Notas del pedido') !!}
				<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" title="Esta sección es muy util para tomar pequeños apuntes sobre tus pedidos o mantener apuntes mientras estás mediando una devolución con un vendedor."></i>
				{!! Form::textarea('notes',null,['class'=>'form-control','placeholder'=>'Vendedor confirmó dirección','rows'=>'1']) !!}
			</div>
		</div>
	</div> {{-- .ROW --}}
</div>

	<div id="mensaje">
		<ul>
				
		</ul>
	</div>

	{{-- Esto es solo para el boton --}}

	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<div class="form-group" style="padding-right: 20px; padding-left: 20px;">
				{!! Form::submit('Registrar pedido',['class'=>'btn btn-primary','style'=>'width: 100%; margin-top: 35px; margin-bottom: 30px;','id'=>'btn_main']) !!}
				<div id="load" class="progress progress-striped active">
				  <div class="progress-bar" role="progressbar"
				       aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
				       style="width: 100%">
				  </div>
				</div>
			</div>


		</div>
	</div>

	{!! Form::close() !!}
@endsection

@section('js')
<link rel="stylesheet" type="text/css" href="{{ asset('pluggins/chosen/chosen.css') }}">
<script src="{{ asset('pluggins/chosen/chosen.js') }}"></script>
<script>
	$(function(){
		$(".chosen-select").chosen({
			disable_search_threshold: 10,
		    no_results_text: "No hay resultados",
		    width: "100%"
		});
		$('[data-toggle="tooltip"]').tooltip();
		$('#mensaje').css('display','none');
		$('#load').css('display','none');
		
		// Función para agregar productos
		$('#btn_product').on('click',function(){
			var producto = $('#full_product').clone(); //Clonado
			producto.find('.form-control').val(""); //Limpiado de valores
			producto.find('.unit_price, .shipping_cost').val(0); // Asignando valor por defecto
			producto.find('.quantity').val(1);
			producto.find('.estado').val('new');
			$('.container_product').prepend(producto); //Agregado
			$('[data-toggle="tooltip"]').tooltip(); //Activando la ayuda del nuevo div
			//ELIMINAR UN AGREGAR PRODUCTO
			$('#close_form').on('click',function(e){
				e.preventDefault();
				if (confirm('¿Está seguro de eliminar este producto?')) {
				$(this).find('.form-control').val(""); //Limpiado de valores
				hideEfect = $(this).parents('.full_product');
				$(hideEfect).hide('slow',function(){
					hideEfect.remove();
				});
				}
			});
			//END
		});

		//ELIMINAR UN AGREGAR PRODUCTO
			$('#close_form').on('click',function(e){
				e.preventDefault();
				alert('Necesitará de almenos un producto para crear el pedido.');
			});
			//END

		$('#btn_main').on('click',function(e){
			e.preventDefault();
			var action = $('#mainform').attr('action');
			var method = $('#mainform').attr('method');

			$.ajax({
			beforeSend:function(){
				$('#mensaje ul').html("");
				$('#mensaje').removeClass();
				$('#mensaje').css('display','none');
				$('#mensaje').css('display','block');
			var ax = 0;
			},
			url: action,
			type: method,
			data: $('#mainform').serialize(),
			dataType:'json',
			success:function(data){
				$('#load').css('display','none');
				$('#btn_main').css('display','block');
				$('#mensaje').addClass('alert alert-success');
				$('#mensaje').css('display','block');

				$.each(data,function(indice,valor){
					$.each(valor,function(key,val){
						$('#mensaje ul').append('<li>' + val + '</li>');
					});
				});	
				ax=1;
			},
			error:function(jqXHR,estado,error){
				$('#load').css('display','none');
				$('#btn_main').css('display','block');
				$('#mensaje').addClass('alert alert-danger');
				$('#mensaje').css('display','block');
				
				if(jqXHR.responseJSON){
				$.each(jqXHR.responseJSON,function(indice,valor){
					$.each(valor,function(key,val){
						$('#mensaje ul').append('<li>' + val + '</li>');
					});
				});	
				
				}else{
					$('#mensaje ul').html('<li>' + estado + '</li>');
					$('#mensaje ul').html('<li>' + error + '</li>');
				}
				ax=0;
				
			},
			complete:function(jqXHR,estado){
				if (ax>0) {
					$('#mainform')[0].reset();
				}
			},
			timeout:15000
			});
		});

		
	});
</script>
@endsection