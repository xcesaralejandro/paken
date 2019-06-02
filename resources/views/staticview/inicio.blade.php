@extends('layouts.main')

@section('title', 'Inicio')

@section('content')
<div class="text-center">
	<h2 style="margin-bottom: 40px;"><i class="fa fa-columns" aria-hidden="true"></i> Dashboard</h2>
	<hr>
</div>

{{-- 2 DIV AZULES --}}

<div class="row">
	<div class="col-sm-6">
		<div class="cajonsito colorAzul borderDos">
			
			<div class="row">
				
				<div class="col-sm-4 text-center">
					<span class="numberDashboard">
						@if($datos['finalizado']>= 1 && $datos['finalizado']<= 9)
							0{{ $datos['finalizado'] }}
						@else
							{{ $datos['finalizado'] }}
						@endif
					</span>
				</div>
				<div class="col-sm-8 text-center">
					<span class="titleDashboard">
						@if($datos['finalizado'] == 1)
							Compra finalizada
						@else
							Compras finalizadas
						@endif
					</span>
				</div>
				
			</div>

		</div>
	</div>

	<div class="col-sm-6">
		<div class="cajonsito colorAzul borderDos">
			
			<div class="row">
				
				<div class="col-sm-4 text-center">
					<span class="numberDashboard">
						@if($datos['reembolsado']>= 1 && $datos['reembolsado']<= 9)
							0{{ $datos['reembolsado'] }}
						@else
							{{ $datos['reembolsado'] }}
						@endif
					</span>
				</div>
				<div class="col-sm-8 text-center">
					<span class="titleDashboard">
						@if($datos['reembolsado'] == 1)
							Compra reembolsada
						@else
							Compras reembolsadas
						@endif
					</span>
				</div>
				
			</div>

		</div>
	</div>
</div>

{{-- FIN 2 DIV AZULES --}}

{{-- 4 DIV VERDE --}}
<div class="row">
	
	<div class="col-sm-3 text-center">
		<div class="cajonsito colorVerde borderUno">
			<span class="numberDashboard">
				@if($datos['pedidos']>= 1 && $datos['pedidos']<= 9)
					0{{ $datos['pedidos'] }}
				@else
					{{ $datos['pedidos'] }}
				@endif
			</span><br>
			<span class="subNumberDashboard">
				@if($datos['pedidos'] == 1)
					Compra realizada
				@else
					Compras realizadas
				@endif
			</span>
		</div>
	</div>

	<div class="col-sm-3 text-center">
		<div class="cajonsito colorVerde borderUno">
			<span class="numberDashboard">
				@if($datos['productos']>= 1 && $datos['productos']<= 9)
					0{{ $datos['productos'] }}
				@else
					{{ $datos['productos'] }}
				@endif
			</span><br>
			<span class="subNumberDashboard">
				@if($datos['productos'] == 1)
					Producto diferente
				@else
					Productos diferentes
				@endif
			</span>
		</div>
	</div>

	<div class="col-sm-3 text-center">
		<div class="cajonsito colorVerde borderUno">
			<span class="numberDashboard">
				@if($datos['tiendas']>= 1 && $datos['tiendas']<= 9)
					0{{ $datos['tiendas'] }}
				@else
					{{ $datos['tiendas'] }}
				@endif
			</span><br>
			<span class="subNumberDashboard">
				@if($datos['tiendas'] == 1)
					Tienda diferente
				@else
					Tiendas diferentes
				@endif
			</span>
		</div>
	</div>

	<div class="col-sm-3 text-center">
		<div class="cajonsito colorVerde borderUno">
			<span class="numberDashboard">
				@if($datos['vendedores']>= 1 && $datos['vendedores']<= 9)
					0{{ $datos['vendedores'] }}
				@else
					{{ $datos['vendedores'] }}
				@endif
			</span><br>
			<span class="subNumberDashboard">
				@if($datos['vendedores'] == 1)
					Vendedor diferente
				@else
					Vendedores diferentes
				@endif
			</span>
		</div>
	</div>

</div>
{{-- FIN 4 DIV VERDE --}}

{{-- DIV MORADO --}}
<div class="row">
	<div class="col-sm-6 text-center">
		<div class="cajonsito colorRosa borderDos">
			
			<div class="row">
				
				<div class="col-sm-4 text-center">
					<span class="numberDashboard">
						@if($datos['encamino']>= 1 && $datos['encamino']<= 9)
							0{{ $datos['encamino'] }}
						@else
							{{ $datos['encamino'] }}
						@endif
					</span>
				</div>
				<div class="col-sm-8 text-center">
					<span class="titleDashboard">
						@if($datos['encamino'] == 1)
							Pedido en camino
						@else
							Pedidos en camino
						@endif
					</span>
				</div>
				
			</div>

		</div>
	</div>

	<div class="col-sm-6 text-center">
		<div class="cajonsito colorRosa borderDos">
			
			<div class="row">
				
				<div class="col-sm-4 text-center">
					<span class="numberDashboard">
						@if($datos['advertencia']>= 1 && $datos['advertencia']<= 9)
							0{{ $datos['advertencia'] }}
						@else
							{{ $datos['advertencia'] }}
						@endif
					</span>
				</div>
				<div class="col-sm-8 text-center">
					<span class="titleDashboard">
						@if($datos['advertencia'] == 1)
							Pedido fuera de plazo
						@else
							Pedidos fuera de plazo
						@endif
					</span>
				</div>
				
			</div>

		</div>
	</div>
</div>
{{--  FIN DIV MORADO --}}

@endsection