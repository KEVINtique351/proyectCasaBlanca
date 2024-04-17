let ordenServicio=null;
let cliente=null;
function getFactura(){
    var options = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    };

    // Realizar la solicitud fetch
    fetch('/getResolucion/A', options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            
            factura = data[0].data[0]
            console.log('Respuesta del controlador:',factura.numero);
            document.getElementById("txtFactura").value=factura.numero;
            actualizarNumeroFactura(factura)

        })
        .catch(error => {
            console.error('Error al llamar al controlador:', error.message);
            swal("Error!", "En la consulta: " + error.message, "error");
        });
}

function actualizarNumeroFactura(factura){
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    numero=factura.numero + 1;

    // Objeto con los datos a enviar
    var data = {
        id: factura.id,
        estado: factura.estado,
        resolucion: factura.resolucion,
        facturaInicia: factura.facturaInicia,
        facturaFinal: factura.facturaFinal,
        numero: numero
    };

    // Opciones para la solicitud fetch
    var options = {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify(data)
    };

    // Realizar la solicitud fetch
    fetch('/actualizarFacturaConfiguracion', options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Respuesta del controlador:', data);
            swal("Good job!", "Se guardo la Resolución", "success");
        })
        .catch(error => {
            console.error('Error al llamar al controlador:', error.message);
            swal("Error!", "No guardo la Resolución: " + error.message, "error");
        });
}

function getOrdenServicio(){
    txtNumeroOrden=document.getElementById("txtNumeroOrden");

    var options = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    };

    // Realizar la solicitud fetch
    fetch('/buscarOrden/'+txtNumeroOrden.value, options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            ordenServicio=data[0].data['ordenServicio'][0]
            //console.log('Respuesta del controlador:',ordenServicio);

            document.getElementById("txtSubtotal").value=ordenServicio.subTotal
            document.getElementById("txtDeposito").value=ordenServicio.deposito
            document.getElementById("txtIva").value=ordenServicio.iva
            document.getElementById("txtTotal").value=ordenServicio.total
            document.getElementById("txtImpuesto").value=ordenServicio.impuestoConsumo
            
            buscarCliente(ordenServicio.idCliente)
            cargarDetalle(data[0].data['detalle'])
            
           
        })
        .catch(error => {
            console.error('Error al llamar al controlador:', error);
            swal("Error!", "En la consulta: " + error.message, "error");
        });
}

function buscarCliente(idCliente){
    var options = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    };

    // Realizar la solicitud fetch
    fetch('/getClienteById/'+idCliente, options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            cliente=data[0].data
            console.log('Respuesta del controlador:',cliente);
            document.getElementById("txtCliente").value=cliente.id+"|"+cliente.identificacion+" "+cliente.nombres+" "+cliente.apellidos

        })
        .catch(error => {
            console.error('Error al llamar al controlador:', error.message);
            swal("Error!", "En la consulta: " + error.message, "error");
        });
}

function cargarDetalle(detalle){
    if(detalle['detalleSalon'].length>0){

        cargarDetalleSalon(detalle['detalleSalon']);
    }

    if(detalle['detalleServicios'].length>0){
    
        cargarDetalleServicios(detalle['detalleServicios']);
    }

    if(detalle['detalleOtroServicios'].length>0){
    
        cargarDetalleOtroServicios(detalle['detalleOtroServicios']);
    }
}

function cargarDetalleSalon(detalle){

    var tablaSalones = document.getElementById("tablaSalones");
    var tbody = tablaSalones.querySelector("tbody");
    // Limpiar tbody antes de agregar las nuevas filas
    if (!tbody) {
        tbody = document.createElement("tbody");
        tablaSalones.appendChild(tbody);
    } else {
        tbody.innerHTML = "";
    }
    if (detalle == null) {
        return
    }
    detalle.forEach(function (salon, index) {
        var fila = document.createElement("tr");

        // Crear celdas para cada propiedad del salón
        var idCell = document.createElement("td");
        idCell.textContent = salon.id;
        fila.appendChild(idCell);

        var nombreCell = document.createElement("td");
        nombreCell.textContent = salon.idSalon;
        fila.appendChild(nombreCell);

        var diaCell = document.createElement("td");
        diaCell.textContent = salon.dia; // Suponiendo que 'dia' es una propiedad del salón
        fila.appendChild(diaCell);

        var cantidadCell = document.createElement("td");
        cantidadCell.textContent = salon.cantidad;
        fila.appendChild(cantidadCell);

        var valorUnitarioCell = document.createElement("td");
        valorUnitarioCell.textContent = salon.valorUnitario;
        fila.appendChild(valorUnitarioCell);

        var valorTotalCell = document.createElement("td");
        valorTotalCell.textContent = salon.valorTotal;
        fila.appendChild(valorTotalCell);
        // Agregar la fila a tbody
        tbody.appendChild(fila);
    });

  
}

function cargarDetalleServicios(detalle){
    var tablaServicio = document.getElementById("tablaServicio");
    var tbody = tablaServicio.querySelector("tbody");
    // Limpiar tbody antes de agregar las nuevas filas
    if (!tbody) {
        tbody = document.createElement("tbody");
        tablaServicio.appendChild(tbody);
    } else {
        tbody.innerHTML = "";
    }
    if (detalle == null) {
        return
    }
    detalle.forEach(function (servicio, index) {
        var fila = document.createElement("tr");

        // Crear celdas para cada propiedad del salón
        var idCell = document.createElement("td");
        idCell.textContent = servicio.id;
        fila.appendChild(idCell);

        var nombreCell = document.createElement("td");
        nombreCell.textContent = servicio.idServicio;
        fila.appendChild(nombreCell);

        var diaCell = document.createElement("td");
        diaCell.textContent = servicio.dia; // Suponiendo que 'dia' es una propiedad del salón
        fila.appendChild(diaCell);

        var cantidadCell = document.createElement("td");
        cantidadCell.textContent = servicio.cantidad;
        fila.appendChild(cantidadCell);

        var valorUnitarioCell = document.createElement("td");
        valorUnitarioCell.textContent = servicio.valorUnitario;
        fila.appendChild(valorUnitarioCell);

        var valorTotalCell = document.createElement("td");
        valorTotalCell.textContent = servicio.valorTotal;
        fila.appendChild(valorTotalCell);
        // Agregar la fila a tbody
        tbody.appendChild(fila);
    });

}

function cargarDetalleOtroServicios(detalle){
    var tablaOtrosServicio = document.getElementById("tablaOtrosServicio");
    var tbody = tablaOtrosServicio.querySelector("tbody");
    // Limpiar tbody antes de agregar las nuevas filas
    if (!tbody) {
        tbody = document.createElement("tbody");
        tablaOtrosServicio.appendChild(tbody);
    } else {
        tbody.innerHTML = "";
    }
    if (detalle == null) {
        return
    }
    detalle.forEach(function (otro, index) {
        var fila = document.createElement("tr");

        // Crear celdas para cada propiedad del salón
        var idCell = document.createElement("td");
        idCell.textContent = otro.id;
        fila.appendChild(idCell);

        var nombreCell = document.createElement("td");
        nombreCell.textContent = otro.idOtros;
        fila.appendChild(nombreCell);

        var diaCell = document.createElement("td");
        diaCell.textContent = otro.dia; // Suponiendo que 'dia' es una propiedad del salón
        fila.appendChild(diaCell);

        var cantidadCell = document.createElement("td");
        cantidadCell.textContent = otro.cantidad;
        fila.appendChild(cantidadCell);

        var valorUnitarioCell = document.createElement("td");
        valorUnitarioCell.textContent = otro.valorUnitario;
        fila.appendChild(valorUnitarioCell);

        var valorTotalCell = document.createElement("td");
        valorTotalCell.textContent = otro.valorTotal;
        fila.appendChild(valorTotalCell);
        // Agregar la fila a tbody
        tbody.appendChild(fila);
    });

}

function calcularCambio(){
    var medioPago = document.getElementById("cbMedioPago");
    var txtTotal = document.getElementById("txtTotal");
    var txtValorPagado = document.getElementById("txtValorPagado");
    var txtValorCambio = document.getElementById("txtValorCambio");
    txtValorCambio.value=0;
    if(medioPago.value=="E"){
        txtValorCambio.value= txtValorPagado.value - txtTotal.value 
    }
}

function guardar(){
    id=document.getElementById("id").value;
    factura=document.getElementById("txtFactura").value;
    //ordenServicio=document.getElementById("txtNumeroOrden").value;
    //cliente=document.getElementById("txtCliente").value;
    subTotal=document.getElementById("txtSubtotal").value;
    deposito=document.getElementById("txtDeposito").value;
    iva=document.getElementById("txtIva").value;
    impuesto=document.getElementById("txtImpuesto").value;
    total=document.getElementById("txtTotal").value;
    medioPago=document.getElementById("cbMedioPago").value;
    valorPagado=document.getElementById("txtValorPagado").value;
    cambio=document.getElementById("txtValorCambio").value;

    idCliente=cliente.id
    console.log(" *** ",ordenServicio)


    if(id==""){
        crearVenta(factura,idCliente,ordenServicio,subTotal,deposito,iva,impuesto,total,medioPago,valorPagado,cambio)
    }else{

    }
    
}

function crearVenta(factura,idCliente,ordenServicio,subTotal,deposito,iva,impuesto,total,medioPago,valorPagado,cambio){
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    var data = {
        facturaVenta: factura,
        fechaFactura: null,
        idCliente: idCliente,
        idUsuario: null,
        idOrdenServicio: ordenServicio.id,
        subTotal: subTotal,
        deposito: deposito,
        iva: iva,
        impuestoConsumo: impuesto,
        total: total,
        estado: "F",
        medioPago: medioPago,
        valorPagado: valorPagado,
        valorCambio: cambio
    };
    //console.log(currentUser);
    console.log(data)
   
    var options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify(data)
    };

    // Realizar la solicitud fetch
    fetch('/guardarFactura', options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Respuesta del controlador:', data);
            document.getElementById("txtOrdenServicio").value=data;
            swal("Good job!", "Se creo la factura "+ data[0].data, "success");
        })
        .catch(error => {
            console.log(error)
            console.error('Error al llamar al controlador:', error);
            swal("Error!", "No al crear el orden de servicio: "+error.message, "error");
        });
}

function getIdCliente(cliente){
    cl=cliente.split("|");
    return cl[0];
}