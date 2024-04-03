@extends('app')
@extends('topbar')
@section('content')
<br>
    <main class="contenedor-app">

        <div class="card card-service">
            <div class="card-header">
                <h5>Configuración de Salones</h5>
            </div>
            <div class="card-body">

                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="txtParametro" placeholder="Buscar Salon" aria-label="Recipient's username" >
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
                        <td>nombre</td>
                        <td>valor unitario</td>
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
                <label for="">nombre del salon</label>
                <input type="text" id="nombre" class="form-control">
                <label for="">Valor Unitario del salon</label>
                <input type="text" id="valor" class="form-control">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="limpiar()">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="guardar()" data-bs-dismiss="modal">Guardar</button>
            </div>
          </div>
        </div>
      </div>
      <script src="{{ asset('js/salon.js') }}" />
    <script>
        function buducarCliente() {
            alert("hola soy onblur debo buscar un cliente")
        }
    </script>
@endsection
