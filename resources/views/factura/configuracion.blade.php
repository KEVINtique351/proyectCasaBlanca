@extends('app')
@extends('topbar')
@section('content')
<br>
    <main class="contenedor-app">

        <div class="card card-cliente">
            <div class="card-header">
                <h5>Gestión de Facturas</h5>
            </div>
            <div class="card-body">

                <div class="input-group mb-3">
                  
                    <label class="input-group-text" for="inputGroupSelect01">Estado</label>
                    <select class="form-select" id="txtParametro">
                      <option value="@">Choose...</option>
                      <option value="A">Activo</option>
                      <option value="I">Inactivo</option>
                      
                    </select>
                  
                    <button class="btn btn-info" type="button" id="button-addon2" onclick="buscar()"><span class="material-symbols-outlined">
                        search
                        </span></button>
                    <button class="btn btn-primary" type="button" id="button-addon2" data-bs-toggle="modal" data-bs-target="#exampleModal"><span class="material-symbols-outlined">
                        add
                        </span></button>
                </div>

                  <br>
                <table class="table table-bordered table-hover table-striped table-sm">
                    <thead class="table-dark">
                        <td>id</td>
                        <td>Resolución</td>
                        <td>Factura Inicia</td>
                        <td>Factura Final</td>
                        <td>Número Factura</td>
                        <td>Estado</td>
                        <td>acciones</td>
                    </thead>
                    <tbody class="table-group-divider">
                        
                    </tbody>
                </table>
            </div>


        </div>


    </main>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Gestión de Configuración</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form >
                @csrf
                <label for="" style="display: none">id</label>
                <input type="hidden" id="id" class="form-control">
                <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupSelect01">Estado</label>
                  <select class="form-select" id="cbEstado">
                    <option selected>Choose...</option>
                    <option value="A">Activo</option>
                      <option value="I">Inactivo</option>
                  </select>
                </div>
                <label for="">Resolución Dian</label>
                <input type="text" id="txtResolucion" class="form-control">

                <label for="">Número de Factura Inicial</label>
                <input type="text" id="txtFacturaInicial" class="form-control">
                
                
                <label for="">Número de Factura Final</label>
                <input type="text" id="txtFacturaFinal" class="form-control">
                
                <label for="">Número de Factura</label>
                <input type="text" id="txtFactura" class="form-control">

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="limpiar()">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="guardar()" data-bs-dismiss="modal">Guardar</button>
            </div>
          </div>
        </div>
    </div>
      <script src="{{ asset('js/facturaConfiguracion.js') }}" />
     <script>
        function buducarCliente() {
            alert("hola soy onblur debo buscar un cliente")
        }
    </script>
@endsection
