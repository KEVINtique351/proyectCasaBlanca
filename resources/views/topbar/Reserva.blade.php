@extends('app')
@extends('topbar')
@section('content')
    <br>
    <main class="contenedor-app">

        <div class="card card-cliente">
            <div class="card-header">
                <h5>Reservaciones</h5> <button class="btn btn-secondary" onclick="guardarOrden()"><span class="material-symbols-outlined">
                    save
                    </span></button>
                    <button class="btn btn-secondary" onclick="limpiar()"><span class="material-symbols-outlined">
                        cleaning_services
                        </span></button>
            </div>
            <div class="card-body">

                <form action="">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Número de Orden de Servicio</span>
                        <input type="text" class="form-control" id="txtOrdenServicio">
                        <button type="button" class="btn btn-info" onclick="generarPDF()"><span class="material-symbols-outlined">
                            picture_as_pdf
                            </span></button>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Fecha de evento</span>
                        <input type="date" id="txtFechaEvento" class="form-control">
                    </div>
                    
                </form>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      
                       
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseCliente" aria-expanded="false" aria-controls="collapseCliente">
                                    Panel cliente
                                </button>
                            </h2>
                            <div id="collapseCliente" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <form action="">
                                        <label for="" style="display: none">id</label>
                                        <input type="text" id="txtIdCliente" class="form-control">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Tipo Documento</span>
                                            <select class="form-control" id="cbTipo" style="width: 0.5%">
                                                <option value="">Seleccione el tipo de documento</option>
                                                <option value="C.C">CEDULA DE CIUDADANIA</option>
                                                <option value="C.E">CEDULA DE EXTRANJERIA</option>
                                                <option value="NIT">NIT</option>
                                                <option value="PA">PASAPORTE</option>

                                            </select>
                                            <span class="input-group-text" id="basic-addon1">Número de Documento</span>
                                            <input type="text" class="form-control" placeholder="Número de Documento"
                                                aria-label="Text input with dropdown button" id="txtNumero"
                                                onblur="buscarCliente()">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Cliente</span>
                                            <input type="text" id="txtNombres" class="form-control">
                                            <span class="input-group-text" id="basic-addon1">Dirección</span>
                                            <input type="text" id="txtDireccion" class="form-control">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Email</span>
                                            <input type="text" id="txtEmail" class="form-control">
                                            <span class="input-group-text" id="basic-addon1">Contacto</span>
                                            <input type="text" id="txtContacto" class="form-control">
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSalon" aria-expanded="false" aria-controls="collapseSalon"
                                    onclick="findSalones()">
                                    Panel Salones
                                </button>
                            </h2>
                            <div id="collapseSalon" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <table id="tablaSalones" class="table table-bordered table-hover table-striped table-sm">
                                    <thead class="table-dark">

                                        <td>SALONES</td>
                                        <td>DIA</td>
                                        <td>CANTIDAD</td>
                                        <td>VALOR UNITARIO</td>
                                        <td>VALOR TOTAL</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#salonModal">
                                                <span class="material-symbols-outlined">
                                                    add
                                                    </span>
                                            </button>
                                        </td>
                                    </thead>
                                    <tbody class="table-group-divider">

                                    </tbody>
                                    <tfoot>
                                        <thead class="table-dark">

                                            <td>SUB TOTAL SALON</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td id="subTotalSalones">0</td>
                                            <td>

                                            </td>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseServicio" aria-expanded="false"
                                    aria-controls="collapseServicio" onclick="findServicios()">
                                    Panel Servicio de alimentos y bebidas
                                </button>
                            </h2>
                            <div id="collapseServicio" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <table id="tablaServicio" class="table table-bordered table-hover table-striped table-sm">
                                    <thead class="table-dark">

                                        <td>SERVICIO DE ALIMENTOS Y BEBIDAS</td>
                                        <td>DIA</td>
                                        <td>CANTIDAD</td>
                                        <td>VALOR UNITARIO</td>
                                        <td>VALOR TOTAL</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#servicioModal">
                                                <span class="material-symbols-outlined">
                                                    add
                                                    </span>
                                            </button>
                                        </td>
                                    </thead>
                                    <tbody class="table-group-divider">

                                    </tbody>
                                    <tfoot>
                                        <thead class="table-dark">

                                            <td>SUB TOTAL SERVICIO DE ALIMENTOS Y BEBIDAS</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td id="subTotalServicios">0</td>
                                            <td>

                                            </td>
                                    </tfoot>
                                </table>

                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOtro" aria-expanded="false" aria-controls="collapseOtro"
                                    onclick="findOtroServicios()">
                                    Panel Otros
                                </button>
                            </h2>
                            <div id="collapseOtro" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <table id="tablaOtrosServicio"
                                    class="table table-bordered table-hover table-striped table-sm">
                                    <thead class="table-dark">

                                        <td>OTROS</td>
                                        <td>DIA</td>
                                        <td>CANTIDAD</td>
                                        <td>VALOR UNITARIO</td>
                                        <td>VALOR TOTAL</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#otroModal">
                                                <span class="material-symbols-outlined">
                                                    add
                                                    </span>
                                            </button>
                                        </td>
                                    </thead>
                                    <tbody class="table-group-divider">

                                    </tbody>
                                    <tfoot>
                                        <thead class="table-dark">

                                            <td>SUB TOTAL OTROS</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td id="subTotalOtros">0</td>
                                            <td>

                                            </td>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>

                    <table id="tablaTotales" class="table table-bordered table-hover table-striped table-sm">

                        <tbody class="table-group-divider">
                            <tr>
                                <td>SUB TOTAL ORDEN DE SERVICIOS</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td id="subTotalOrden">0</td>

                            </tr>
                            <tr>
                                <td>DEPOSITO REMBOLSABLE 10%</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td id="deposito">0</td>

                            </tr>
                            <tr>
                                <td>IVA 19% (EXTRAJEROS EXENTOS DE IVA)</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td id="iva">0</td>

                            </tr>
                            <tr>
                                <td>IMPUESTO AL CONSUMO 8%</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td id="impuestoConsumo">0</td>

                            </tr>
                            <tr>
                                <th>TOTAL ORDEN DE SERVICIOS</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td id="TotalOden">0</td>

                            </tr>
                        </tbody>

                    </table>




                </div>
             



    </main>


    <div class="modal fade" id="salonModal" tabindex="-1" aria-labelledby="salonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="salonModalLabel">Agregar Salon</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <select class="form-control" id="cbosalon" onblur="getValorUnitario()">
                            <option>Selecciones el salon</option>

                        </select>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Cantidad de días</span>
                            <input type="number" id="txtDia" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Cantidad</span>
                            <input type="number" id="txtCantidad" class="form-control" onblur="calcularSalon()">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Valor Unitario</span>
                            <input type="number" id="txtValor" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Valor Total</span>
                            <input type="number" id="txtTotal" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="agregarSalon()">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="servicioModal" tabindex="-1" aria-labelledby="servicioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="salonModalLabel">Agregar Servicio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <select class="form-control" id="cboServicio" onblur="getValorUnitarioServicio()">
                            <option>Selecciones el servicio</option>

                        </select>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Cantidad de días</span>
                            <input type="number" id="txtDiaServicio" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Cantidad</span>
                            <input type="number" id="txtCantidadSerivicio" class="form-control"
                                onblur="calcularServicio()">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Valor Unitario</span>
                            <input type="number" id="txtValorServicio" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Valor Total</span>
                            <input type="number" id="txtTotalServicio" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="agregarServicio()">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="otroModal" tabindex="-1" aria-labelledby="otroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="salonModalLabel">Agregar Otro Servicio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <select class="form-control" id="cboOtro" onblur="getValorUnitarioOtros()">
                            <option>Selecciones otro servicio</option>

                        </select>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Cantidad de días</span>
                            <input type="number" id="txtDiaOtro" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Cantidad</span>
                            <input type="number" id="txtCantidadOtro" class="form-control" onblur="calcularOtro()">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Valor Unitario</span>
                            <input type="number" id="txtValorOtro" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Valor Total</span>
                            <input type="number" id="txtTotalOtro" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="agregarOtro()">Agregar</button>
                </div>
            </div>
        </div>
    </div>


   
    <script src="{{ asset('js/reserva.js') }}" />
   
    <script>
        function buducarCliente() {
            alert("hola soy onblur debo buscar un cliente")
        }

        window.onload = function() {
            alert("Se ha cargado el archivo");
            // Aquí puedes ejecutar cualquier otra función JavaScript que desees al cargar el archivo
        }
    </script>
@endsection
