<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
        @if (!Auth::guest())
        <ul class="nav navbar-nav">

            <li>
                <a href="{{ route('inicioPrivate') }}"><i class="fa fa-home" aria-hidden="true"></i>
                Inicio</a>
            </li>

            <li>
                <a href="{{ route('orders.create') }}"><i class="fa fa-file-o" aria-hidden="true"></i>
                Agregar</a>
            </li>

            {{-- DROP CONSULTA --}}
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-search" aria-hidden="true"></i>
                Consultas <span class="caret"></span></a>
            
            <ul class="dropdown-menu">
              <li><a href="{{ route('consultas.fecha') }}"><i class="fa fa-calendar" aria-hidden="true"></i> Rango de fechas</a></li>
              <li><a href="{{ route('consultas.estado') }}"><i class="fa fa-star-half-o" aria-hidden="true"></i> Estado de pedidos</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ route('consultas.tienda') }}"><i class="fa fa-building" aria-hidden="true"></i> Nombre de tienda</a></li>
              <li><a href="{{ route('consultas.vendedor') }}"><i class="fa fa-user" aria-hidden="true"></i> Nombre de vendedor</a></li>
              <li><a href="{{ route('consultas.producto') }}"><i class="fa fa-tag" aria-hidden="true"></i> Nombre de producto</a></li>
            </ul>
            {{-- END DROP CONSULTA --}}

            
            <li>
                <a href="{{ route('pedidos') }}"><i class="fa fa-files-o" aria-hidden="true"></i>
                Historial</a>
            </li>

            <li>
                <a href="{{ route('support') }}"><i class="fa fa-comments-o" aria-hidden="true"></i>
                Soporte</a>
            </li>

        </ul>
        @endif

      <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Iniciar Sesión</a></li>
                            <li><a href="{{ route('register') }}"><i class="fa fa-id-card" aria-hidden="true"></i> Registrarse</a></li>
                        @else
                            <li class="dropdown">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i> Salir
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>