@section('topbar')
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">CASA BLANCA</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Inicia seccion</a>
                </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Reserva</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Caja</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contacto</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Configuraciones</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/salones">Salones</a></li>
                  <li><a class="dropdown-item" href="/servicios">Servicios de comida y bebida</a></li>
                  <li><a class="dropdown-item" href="/otroServicio">Otros servicios</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
@endsection