@extends('layouts.main')
@section('title','Historial de compras')

@section('infobar')

<div class="all_resumen text-center">
	Pedidos: <strong>{{ $total }}</strong>
	<a href="/consultas/estados/enviar?state=En+Camino&orden=buy_date&modo=desc">En Camino: <strong>{{ $camino }}</strong></a>
	<a href="/consultas/estados/enviar?state=Recibido&orden=buy_date&modo=desc">Recibidos: <strong>{{ $recibidos }}</strong></a>
	<a href="/consultas/estados/enviar?state=Finalizado&orden=buy_date&modo=desc">Finalizados: <strong>{{ $finalizados }}</strong></a>
	<a href="/consultas/estados/enviar?state=En+Mediación&orden=buy_date&modo=desc">En Mediación: <strong>{{ $mediacion }}</strong></a>
	<a href="/consultas/estados/enviar?state=En+Disputa&orden=buy_date&modo=desc">En Disputa: <strong>{{ $disputa }}</strong></a>
	<a href="/consultas/estados/enviar?state=En+Devolución&orden=buy_date&modo=desc">En Devolución: <strong>{{ $devolucion }}</strong></a>
	<a href="/consultas/estados/enviar?state=Reembolsado&orden=buy_date&modo=desc">Reembolsado: <strong>{{ $reembolsado }}</strong></a>	
</div>

@endsection

@section('content')
@if($total == 0)
	<div class="text-center">
		<i class="fa fa-frown-o" aria-hidden="true" style="font-size: 300px;"></i>
		<h2>Aún no tienes compras registradas</h2>
		<a href="{{ route('orders.create') }}" class="btn btn-primary">Agregar una compra</a>
	</div>

@else
	
<style type="text/css">
	.panel{background-color: #f3f3f3 !important;}
	.product{background-color: #fff !important;}
	td{padding-left: 5px;}
</style>

@if($advertencias > 0)
<div class="consulta_style text-center" style="background-color: #fff !important;">
	<h3><span style="color: #FF4800;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span> Advertencia !</h3>
	<span style="font-size: 15px;">Hay <strong style="color: #FF4800; font-size: 18px;">{{ $advertencias }}</strong>
	@if($advertencias == 1)
		pedido
	@else
		pedidos
	@endif
	 que deberias cambiar de estado, ya que <strong>el plazo maximo de llegada prometido por el vendedor ha expirado.</strong></span>

	 <div class="text-center">
	 	<a href="{!! route('consultas.expirado.search') !!} " class="btn btn-primary" style="margin-top: 20px;"><i class="fa fa-search" aria-hidden="true"></i> Ver todos los pedidos</a>
	 </div>
</div>
@endif

@foreach($order as $pedido)
<div class="info_full">  
	
	@if($pedido->state === 'En Camino')
		<div class="resumen_info bg_salmon" id="pedidofullinfo">
	
	@elseif($pedido->state === 'Recibido')
		<div class="resumen_info bg_recibido" id="pedidofullinfo">

	@elseif($pedido->state === 'Finalizado')
		<div class="resumen_info bg_finalizado" id="pedidofullinfo">

	@elseif($pedido->state === 'En Mediación')
		<div class="resumen_info bg_mediacion" id="pedidofullinfo">

	@elseif($pedido->state === 'En Disputa')
		<div class="resumen_info bg_disputa" id="pedidofullinfo">

	@elseif($pedido->state === 'En Devolución')
		<div class="resumen_info bg_devolucion" id="pedidofullinfo">

	@elseif($pedido->state === 'Reembolsado')
		<div class="resumen_info bg_reembolsado" id="pedidofullinfo">
	@else
		<div class="resumen_info bg_salmon" id="pedidofullinfo">
	@endif 
		<div class="row">
			<div class="col-sm-9">
				pedido con {{ count($pedido->products) }} 
				@if(count($pedido->products)==1)
					<strong>Producto</strong>
				@else
					<strong>Productos</strong>
				@endif

			</div>
			<div class="col-sm-3 text-right" style="padding-right: 20px;" id="action_full_pedido">
				@if($pedido->tracking_number)
					<a href="http://www.17track.net/es/track?nums={{ $pedido->tracking_number }}" target="_blank"><i class="fa fa-globe" aria-hidden="true"></i></a>
					<a href="http://www.correos.cl/SitePages/seguimiento/seguimiento.aspx?envio={{ $pedido->tracking_number }}" target="_blank"><i class="fa fa-truck" aria-hidden="true"></i></a>
				@endif
				<a href="{{ route('orders.edit',$pedido->id) }}"><i class="fa fa-cog" aria-hidden="true"></i></a>
				<a class="deleteorder" href="{{ route('orders.destroy',$pedido->id) }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
	<div class="product">
		<div class="row">
			<div class="col-md-3 text-center">
@if($pedido->state === 'En Camino')
    <img src="{{ asset('images/camion_encamino.svg') }}" height="150">
@elseif($pedido->state === 'Recibido')
   <img src="{{ asset('images/camion_recibido.svg') }}" height="150">
@elseif($pedido->state === 'Finalizado')
    <img src="{{ asset('images/camion_finalizado.svg') }}" height="150">
@elseif($pedido->state === 'En Mediación')
    <img src="{{ asset('images/camion_mediacion.svg') }}" height="150">
@elseif($pedido->state === 'En Disputa')
    <img src="{{ asset('images/camion_disputa.svg') }}" height="150">
@elseif($pedido->state === 'En Devolución')
    <img src="{{ asset('images/camion_devolucion.svg') }}" height="150">
@elseif($pedido->state === 'Reembolsado')
   <img src="{{ asset('images/camion_reembolsado.svg') }}" height="150">
@else
    <img src="{{ asset('images/camion_encamino.svg') }}" height="150">
@endif 
				<br />
			</div>
			<div class="col-md-9">
				<div class="text-right">
				<span style="border-bottom: 1px solid #bfbfbf; padding-bottom: 2px;">
					<span style="color: #369e00; font-weight: bold;">{{ $pedido->buy_date }}</span> <strong>||</strong> <span style="color: #FF4E00; font-weight: bold;">{{ $pedido->arrival_date }}</span>
				</span>
				</div>

				<table>
					<tr>
						<th>Tienda</th>
						<td><strong>:</strong></td>
						<td>
							@if($pedido->store)
								{{ $pedido->store }}
							@else
								<span class="text_light_gray">Campo vació</span>
							@endif
						</td>
					</tr>

					<tr>
						<th>Vendedor</th>
						<td><strong>:</strong></td>
						<td>
							@if($pedido->seller)
								{{ $pedido->seller }}
							@else
								<span class="text_light_gray">Campo vació</span>
							@endif
						</td>
					</tr>

					<tr>
						<th>Estado</th>
						<td><strong>:</strong></td>
						<td>



@if($pedido->state === 'En Camino')
		<span class="stateinkja bg_salmon"> {{ $pedido->state }} </span>
	
	@elseif($pedido->state === 'Recibido')
		<span class="stateinkja bg_recibido"> {{ $pedido->state }} </span>

	@elseif($pedido->state === 'Finalizado')
		<span class="stateinkja bg_finalizado"> {{ $pedido->state }} </span>

	@elseif($pedido->state === 'En Mediación')
		<span class="stateinkja bg_mediacion"> {{ $pedido->state }} </span>

	@elseif($pedido->state === 'En Disputa')
		<span class="stateinkja bg_disputa"> {{ $pedido->state }} </span>

	@elseif($pedido->state === 'En Devolución')
		<span class="stateinkja bg_devolucion"> {{ $pedido->state }} </span>

	@elseif($pedido->state === 'Reembolsado')
		<span class="stateinkja bg_reembolsado"> {{ $pedido->state }} </span>
	@else
		<span class="stateinkja bg_salmon"> {{ $pedido->state }} </span>
	@endif 



						</td>
					</tr>

					<tr>
						<th>N° SEG</th>
						<td><strong>:</strong></td>
						<td>
							@if($pedido->tracking_number)
								{{ $pedido->tracking_number }}
							@else
								<span class="text_light_gray">Campo vació</span>
							@endif
						</td>
					</tr>

					<tr>
						<th>M. Pago</th>
						<td><strong>:</strong></td>
						<td>{{ $pedido->Payment->name }}</td>
					</tr>

					<tr>
						<th>Notas</th>
						<td><strong>:</strong></td>
						@if(!$pedido->notes)
							<td>
								<span class="text_light_gray">Campo vació</span>
							</td>
						@else
							<td>{{ $pedido->notes }}</td>
						@endif
					</tr>

						
				</table>
			</div>
		</div> {{-- .row --}}
		<div>
			<div class="text-center note_icon" id="contenedorverproductos">
				<a class="showorhideproduct" href="">
					<div class="content_center">


	@if($pedido->state === 'En Camino')
		<span class="verproductos mybtn bg_default_salmon hoverdiv">
	
	@elseif($pedido->state === 'Recibido')
		<span class="verproductos mybtn bg_recibido hoverdiv">

	@elseif($pedido->state === 'Finalizado')
		<span class="verproductos mybtn bg_finalizado hoverdiv">

	@elseif($pedido->state === 'En Mediación')
		<span class="verproductos mybtn bg_mediacion hoverdiv">

	@elseif($pedido->state === 'En Disputa')
		<span class="verproductos mybtn bg_disputa hoverdiv">

	@elseif($pedido->state === 'En Devolución')
		<span class="verproductos mybtn bg_devolucion hoverdiv">

	@elseif($pedido->state === 'Reembolsado')
		<span class="verproductos mybtn bg_reembolsado hoverdiv">
	@else
		<span class="verproductos mybtn bg_default_salmon hoverdiv">
	@endif 
						
							<i class="fa fa-angle-double-down show_note" aria-hidden="true"></i>
							<span class="sorhtext">Ver productos</span>
						</span>
					</div>
				</a>
			</div>

			@foreach($pedido->products as $producto)
			


			@if($pedido->state === 'En Camino')
				<div class="product_content text-left display_product mainkja kja_camino">
			
			@elseif($pedido->state === 'Recibido')
				<div class="product_content text-left display_product mainkja kja_recibido">

			@elseif($pedido->state === 'Finalizado')
				<div class="product_content text-left display_product mainkja kja_finalizado">

			@elseif($pedido->state === 'En Mediación')
				<div class="product_content text-left display_product mainkja kja_mediacion">

			@elseif($pedido->state === 'En Disputa')
				<div class="product_content text-left display_product mainkja kja_disputa">

			@elseif($pedido->state === 'En Devolución')
				<div class="product_content text-left display_product mainkja kja_devolucion">

			@elseif($pedido->state === 'Reembolsado')
				<div class="product_content text-left display_product mainkja kja_reembolsado">
			@else
				<div class="product_content text-left display_product mainkja kja_camino">
			@endif


			
				<div class="row">
			<div class="kjaname">

			@if($pedido->state === 'En Camino')
				<div class="kjacolor bg_salmon">
				<span>
			
			@elseif($pedido->state === 'Recibido')
				<div class="kjacolor bg_recibido">
				<span>

			@elseif($pedido->state === 'Finalizado')
				<div class="kjacolor bg_finalizado">
					<span>

			@elseif($pedido->state === 'En Mediación')
				<div class="kjacolor bg_mediacion">
					<span>

			@elseif($pedido->state === 'En Disputa')
				<div class="kjacolor bg_disputa">
					<span>

			@elseif($pedido->state === 'En Devolución')
				<div class="kjacolor bg_devolucion">
					<span>

			@elseif($pedido->state === 'Reembolsado')
				<div class="kjacolor bg_reembolsado">
					<span>
			@else
				<div class="kjacolor bg_salmon">
					<span>
			@endif 

				
					{{ $producto->name }}
				</span>
				</div>
			</div>
						
					<div class="col-sm-12 col-md-4 kja">
						<table>

							<tr>
								<th>Marca</th>
								<td><strong>:</strong></td>
								<td>
									@if($producto->brand)
										{{ $producto->brand }}
									@else
										<span class="text_light_gray">Campo vació</span>
									@endif
								</td>

							</tr>
							<tr>
								<th>Modelo</th>
								<td><strong>:</strong></td>
								<td>
									@if($producto->model)
										{{ $producto->model }}
									@else
										<span class="text_light_gray">Campo vació</span>
									@endif
								</td>
							</tr>

							<tr>
								<th>SKU</th>
								<td><strong>:</strong></td>
								<td>
									@if($producto->sku)
										{{ $producto->sku }}
									@else
										<span class="text_light_gray">Campo vació</span>
									@endif
								</td>

							</tr>

						</table>
					</div>

					<div class="col-sm-6 col-md-4 kja">
						<table>
							<tr>
								<th>Tamaño</th>
								<td><strong>:</strong></td>
								<td>
									@if($producto->size)

										{{ $producto->size }}

									@else
										<span class="text_light_gray">Estándar</span>
									@endif
								</td>

							</tr>
							<tr>
								<th>Color</th>
								<td><strong>:</strong></td>
								<td>
									@if($producto->colour)
										{{ $producto->colour }}
									@else
										<span class="text_light_gray">Campo vació</span>
									@endif
								</td>

							</tr>
							<tr>
								<th>Material</th>
								<td><strong>:</strong></td>
								<td>
									@if($producto->material)
										{{ $producto->material }}
									@else
										<span class="text_light_gray">Campo vació</span>
									@endif
								</td>
							</tr>

							<tr>
								<th>Estado</th>
								<td><strong>:</strong></td>
								<td>
									@if($producto->estado == 'new')
										Nuevo
									@elseif($producto->estado == 'used')
										Usado
									@else
										<span class="text_light_gray">Campo vació</span>
									@endif
								</td>

							</tr>
							

						</table>
					</div>
					<div id="tourl" class="col-sm-6 col-md-4 kja">
						<table>
							<tr>
								<th>Cantidad</th>
								<td><strong>:</strong></td>
								<td>{{ $producto->quantity }}</td>

							</tr>

							<tr>
								<th>Val. Unit</th>
								<td><strong>:</strong></td>
								<td>{{ $producto->unit_price }}</td>

							</tr>
							<tr>
								<th>Val. Envi</th>
								<td><strong>:</strong></td>
								<td>
									@if($producto->shipping_cost == 0)
										<span style="color: #369e00;">Envío gratuito</span>
									@else
										{{ $producto->shipping_cost }}
									@endif

								</td>
							</tr>

							<tr>
								<th>URL</th>
								<td><strong>:</strong></td>
								<td>
								@if($producto->url_product)
										<a href="{{ $producto->url_product }}" target="_blank"><i class="fa fa-link" aria-hidden="true"></i> Ver producto</a>
									@else
										<span class="text_light_gray">Campo vació</span>
									@endif
								</td>
							</tr>
						</table>
					</div>
				</div>{{-- .row product  --}}
			</div>
			@endforeach
		</div>
	</div>
</div>
@endforeach
<div class="text-center">
	{{ $order->render() }}
</div>
@endif
@endsection

@section('js')
<script>

	$(function(){
		// MOSTRAR - OCULTAR PRODUCTOS
		var products = $('.showorhideproduct');
		products.on('click',function(e){
			e.preventDefault();
			var tohide = $(this).find('.sorhtext').text();
			if (tohide === 'Ver productos') {
				var xd = $(this).parents('.product').find('.display_product');
				xd.slideToggle('slow',function(){
					xd.css('display','block');
				});
				$(this).fadeIn().find('.sorhtext').text('Ocultar productos');
				$(this).find('i').removeClass().addClass('fa fa-angle-double-up');
			}else{
				var bb = $(this).parents('.product').find('.display_product');
				bb.slideToggle('slow',function(){
					bb.css('display','none');
				});
				$(this).fadeIn().find('.sorhtext').text('Ver productos');
				$(this).find('i').removeClass().addClass('fa fa-angle-double-down');
			}
		});
		// END HIDE-SHOW DESCRIPTION
		
		// Borrar order
		var trash = $('a.deleteorder');
		trash.on('click',function(e){
			e.preventDefault();
			var link = $(this).attr('href');
			var conf = confirm('¿Está seguro que desea eliminar la orden con todos sus productos?');

			if (conf) {
				var tis = $(this);	
				$.ajax({
					url: link,
					type: 'GET',
					success : function(resp){
						tis.parents('.info_full').hide('slow',function(){
							tis.css('display','none');
						});	
					},
					error : function(jqXHR,status,error){
						alert('No se ha podido eliminar el pedido, intentalo más tarde o ponte en contacto con el soporte');
					}
				});
			}


			}); // End delete order

	}); //FUNCTION LOAD

</script>
@endsection