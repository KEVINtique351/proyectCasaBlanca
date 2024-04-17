@extends('app')
@extends('topbar')
@section('content')
    <br>
    <main class="contenedor-app">

        <div class="card card-cliente">
            <div class="card-header">
                <h5>Caja</h5>
            </div>
            <div class="card-body">



                <div class="card">
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Número de Factura</span>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                                aria-describedby="basic-addon1">
                            <span class="input-group-text">Fecha de Factura</span>
                            <input type="text" class="form-control" placeholder="Server" aria-label="Server">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Cliente</span>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                                aria-describedby="basic-addon1">
                            <span class="input-group-text">Usuario</span>
                            <input type="text" class="form-control" placeholder="Server" aria-label="Server">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Orden de Servicio</span>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                                aria-describedby="basic-addon1">

                        </div>
                        <button class="btn btn-info" type="button" id="button-addon2" onclick="buscar()"><span
                                class="material-symbols-outlined">
                                search
                            </span></button>
                        <button class="btn btn-primary" type="button" id="button-addon2" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"><span class="material-symbols-outlined">
                                add
                            </span></button>
                    </div>
                </div>
                <br>
                <table class="table table-bordered table-hover table-striped table-sm">
                    <thead class="table-dark">
                        <td>id</td>
                        <td>Factura</td>
                        <td>Fecha de Factura</td>
                        <td>Cliente</td>
                        <td>Usuario</td>
                        <td>Orden de Servicio</td>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Factura de Venta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                        @csrf
                        <label for="" style="display: none">id</label>
                        <input type="hidden" id="id" class="form-control">

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Número de Factura</span>
                            <input type="text" class="form-control" id="txtFactura" aria-describedby="basic-addon1">
                            <button class="btn btn-info" onclick="getFactura()">Obtener</button>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Orden de Servicio</span>
                            <input type="text" class="form-control" id="txtNumeroOrden" aria-describedby="basic-addon1">
                            <button class="btn btn-info" onclick="getOrdenServicio()">Buscar</button>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Cliente</span>
                            <input type="text" id="txtCliente" class="form-control" aria-describedby="basic-addon1">
                        </div>

                        <table id="tablaSalones" class="table table-bordered table-hover table-striped table-sm">
                            <thead class="table-dark">
                                <td>id</td>
                                <td>Salones</td>
                                <td>dia</td>
                                <td>Cantidad</td>
                                <td>Valor Unitario</td>
                                <td>Valor total</td>

                            </thead>
                            <tbody class="table-group-divider">

                            </tbody>
                        </table>

                        <table id="tablaServicio" class="table table-bordered table-hover table-striped table-sm">
                            <thead class="table-dark">
                                <td>id</td>
                                <td>Servicios</td>
                                <td>dia</td>
                                <td>Cantidad</td>
                                <td>Valor Unitario</td>
                                <td>Valor total</td>

                            </thead>
                            <tbody class="table-group-divider">

                            </tbody>
                        </table>

                        <table id="tablaOtrosServicio" class="table table-bordered table-hover table-striped table-sm">
                            <thead class="table-dark">
                                <td>id</td>
                                <td>Otros Servicios</td>
                                <td>dia</td>
                                <td>Cantidad</td>
                                <td>Valor Unitario</td>
                                <td>Valor total</td>

                            </thead>
                            <tbody class="table-group-divider">

                            </tbody>
                        </table>


                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Sub total $ </span>
                            <input type="number" id="txtSubtotal" class="form-control" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Deposito Rembolsable 10%</span>
                            <input type="number" id="txtDeposito" class="form-control" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">IVA 19% (EXTRAJEROS EXENTOS)</span>
                            <input type="number" id="txtIva" class="form-control" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Impuesto al comsumo $ </span>
                            <input type="number" id="txtImpuesto" class="form-control" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Total $ </span>
                            <input type="number" id="txtTotal" class="form-control" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Medio de Pago</label>
                            <select class="form-select" id="cbMedioPago">
                                <option selected>Seleccione...</option>
                                <option value="E">Efectivo</option>
                                <option value="TC">Tarjeta de Crédito</option>
                                <option value="TD">Tarjeta debito</option>
                                <option value="TF">Transferencia</option>
                                <option value="B">Bitcoin</option>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Valor pagado $ </span>
                            <input type="number" id="txtValorPagado" class="form-control" aria-describedby="basic-addon1" onblur="calcularCambio()">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Cambio $</span>
                            <input type="number" id="txtValorCambio" class="form-control" aria-describedby="basic-addon1">
                        </div>

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        onclick="limpiar()">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="guardar()"
                        data-bs-dismiss="modal">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/factura.js') }}" />
    <script>
        function buducarCliente() {
            alert("hola soy onblur debo buscar un cliente")
        }
    </script>
@endsection
