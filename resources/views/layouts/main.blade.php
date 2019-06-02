<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="{{ asset('pluggins/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('pluggins/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
<head>
	<title>@yield('title')</title>
</head>
<body>
@include('partials.navbar')
@yield('infobar')
	<div class="container" style="padding-top:40px;">
@yield('outside')
		<div class="panel panel-default" id="#mainpanel">
		  <div class="panel-heading">@yield('title')<strong class="strongseparator">PAKEN</strong></div>
		  <div class="panel-body">
			
			@yield('content')
		  </div>
		</div>
	</div> {{-- .CONTAINER --}}
	
	<div class="container">
		<div class="container_edit">
			@include('partials.footer');
		</div>
	</div>
	<script src="{{ asset('pluggins/jquery/jquery.js') }}"></script>
	<script src="{{ asset('pluggins/bootstrap/js/bootstrap.js') }}"></script>
	@yield('js')
</body>
</html>