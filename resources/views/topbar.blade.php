@section('topbar')
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">CASA REAL</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Cerrar seccion</a>
                </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('topbar.Reserva') }}">Reserva</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('factura') }}">Caja</a>
              </li>
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Configuraciones</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ route('clientes') }}">Clientes</a></li>
                  <li><a class="dropdown-item" href="{{ route('factura.configuracion') }}">Facturas</a></li>
                  <li><a class="dropdown-item" href="{{ route('salones.index') }}">Salones</a></li>
                  <li><a class="dropdown-item" href="{{ route('ser.servicio') }}">Servicios de comida y bebida</a></li>
                  <li><a class="dropdown-item" href="{{ route('otros.OtroServicios') }}">Otros servicios</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
@endsection