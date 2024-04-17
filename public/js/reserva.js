

function buscarCliente() {
    txtTipo = document.getElementById("cbTipo").value;
    txtNumero = document.getElementById("txtNumero").value;

    valida = validarParametrosClientes(txtTipo, txtNumero)

    if (!valida) {
        alert("para consultar un cliente se requiere de tipo de ducumento y el número de documento")
    }
    var url = '/getClienteByDocumento/' + encodeURIComponent(txtTipo) + '/' + encodeURIComponent(txtNumero);

    var options = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    };

    // Realizar la solicitud fetch
    fetch(url, options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Respuesta del controlador:', data);
            cargarPanelCliente(data[0].data)

        })
        .catch(error => {
            console.error('Error al llamar al controlador:', error.message);
            swal("Error!", "En la consulta: " + error.message, "error");
        });
}

function validarParametrosClientes(tipo, numero) {
    respuesta = true
    if (tipo.trim() === "") {
        respuesta = false
    }
    if (numero.trim() === "") {
        respuesta = false
    }
    return respuesta
}

function cargarPanelCliente(data) {
    cliente = data[0];
    txtTipo = document.getElementById("txtIdCliente").value = cliente.id;
    txtTipo = document.getElementById("txtNombres").value = cliente.nombres + " " + cliente.apellidos;
    txtTipo = document.getElementById("txtDireccion").value = cliente.direccion;
    txtTipo = document.getElementById("txtEmail").value = cliente.email;
    txtTipo = document.getElementById("txtContacto").value = cliente.contacto;
}

/**gestión de salones */
var salones = null;
function findSalones() {
    limpiarFormularioSalones()
    if (salones != null) {
        //cargarSalonesOption(salones)
        return
    }
    var options = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    };

    // Realizar la solicitud fetch
    fetch('/getSalones', options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Respuesta del controlador:', data);
            salones = data[0].data
            cargarSalonesOption(salones)

        })
        .catch(error => {
            console.error('Error al llamar al controlador:', error.message);
            swal("Error!", "En la consulta: " + error.message, "error");
        });
}

function cargarSalonesOption(data) {
    var select = document.getElementById("cbosalon");
    data.forEach(function (dt) {
        var option = document.createElement("option"); // Crea un elemento option
        option.text = dt.nombre; // Establece el texto de la opción
        option.value = dt.id; // Opcional: puedes establecer un valor para la opción
        select.add(option); // Agrega la opción al select
    });
}

function getValorUnitario() {
    var select = document.getElementById("cbosalon");
    selectedSalonId = select.value
    //console.log(salones)
    var selectedSalon = salones.find(function (salon) {
        //console.log(salon.id)
        return salon.id == selectedSalonId;
    });

    document.getElementById("txtValor").value = selectedSalon.valor
}

function calcularSalon() {
    var cantidad = parseFloat(document.getElementById("txtCantidad").value);
    var valor = parseFloat(document.getElementById("txtValor").value);

    // Verificar si la cantidad y el valor son números válidos
    if (!isNaN(cantidad) && !isNaN(valor)) {
        var total = cantidad * valor;
        document.getElementById("txtTotal").value = total.toFixed(2); // Para redondear a 2 decimales
    } else {
        alert("Ingrese valores numéricos válidos para cantidad y valor.");
    }
}

var salonesOrden = []
function agregarSalon() {
    var nombre = document.getElementById("cbosalon").value;
    var dia = parseFloat(document.getElementById("txtDia").value);
    var cantidad = parseFloat(document.getElementById("txtCantidad").value);
    var valor = parseFloat(document.getElementById("txtValor").value);
    var total = parseFloat(document.getElementById("txtTotal").value);
    var selectedSalon = salones.find(function (salon) {
        //console.log(salon.id)
        return salon.id == selectedSalonId;
    });
    var nuevoSalon = {
        nombre: nombre + "-" + selectedSalon.nombre,
        dia: dia,
        cantidad: cantidad,
        valor: valor,
        total: total
    };
    salonesOrden.push(nuevoSalon);

    actualizarSalones()

    calcularTotales()

}

function actualizarSalones() {
    var tablaSalones = document.getElementById("tablaSalones");
    var tbody = tablaSalones.querySelector("tbody");
    // Limpiar tbody antes de agregar las nuevas filas
    if (!tbody) {
        tbody = document.createElement("tbody");
        tablaSalones.appendChild(tbody);
    } else {
        tbody.innerHTML = "";
    }
    if (salonesOrden == null) {
        return
    }
    salonesOrden.forEach(function (salon, index) {
        var fila = document.createElement("tr");

        // Crear celdas para cada propiedad del salón
        var nombreCell = document.createElement("td");
        nombreCell.textContent = salon.nombre;
        fila.appendChild(nombreCell);

        var diaCell = document.createElement("td");
        diaCell.textContent = salon.dia; // Suponiendo que 'dia' es una propiedad del salón
        fila.appendChild(diaCell);

        var cantidadCell = document.createElement("td");
        cantidadCell.textContent = salon.cantidad;
        fila.appendChild(cantidadCell);

        var valorUnitarioCell = document.createElement("td");
        valorUnitarioCell.textContent = salon.valor;
        fila.appendChild(valorUnitarioCell);

        var valorTotalCell = document.createElement("td");
        valorTotalCell.textContent = salon.total;
        fila.appendChild(valorTotalCell);

        // Crear botón para eliminar fila
        var eliminarCell = document.createElement("td");
        var eliminarButton = document.createElement("button");
        eliminarButton.textContent = "Eliminar";
        eliminarButton.classList.add("btn", "btn-danger","material-icons-outlined");
        eliminarButton.onclick = (function (i) {
            return function () {
                eliminarSalon(i);
            };
        })(index);
        eliminarCell.appendChild(eliminarButton);
        fila.appendChild(eliminarCell);
        // Agregar la fila a tbody
        tbody.appendChild(fila);
    });

    // Actualizar el subtotal en el pie de la tabla
    var subtotalCell = document.getElementById("subTotalSalones");
    var subtotal = salonesOrden.reduce(function (total, salon) {
        return total + salon.total;
    }, 0);

    subtotalCell.textContent = subtotal.toFixed(2);
}
function eliminarSalon(index) {
    console.log("indice " + index, salonesOrden);
    if (index > -1) {
        salonesOrden.splice(index, 1);
        console.log("Salón eliminado del array salonesOrden", salonesOrden);
        actualizarSalones();
    } else {
        console.error("Índice de salón inválido");
    }
    calcularTotales()
}

function limpiarFormularioSalones() {
    document.getElementById("cbosalon").value = "";
    document.getElementById("txtDia").value = "0";
    document.getElementById("txtCantidad").value = "0";
    document.getElementById("txtValor").value = "0";
    document.getElementById("txtTotal").value = "0";
}

/**gestión de servicioss */
var servicios = null;
function findServicios() {
    limpiarFormularioServicio()
    if (servicios != null) {
        //cargarSalonesOption(salones)
        return
    }
    var options = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    };

    // Realizar la solicitud fetch
    fetch('/getServicio', options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Respuesta del controlador:', data);
            servicios = data[0].data
            console.log(servicios)
            cargarserviciosOption(servicios)

        })
        .catch(error => {
            console.error('Error al llamar al controlador:', error.message);
            swal("Error!", "En la consulta: " + error.message, "error");
        });
}

function cargarserviciosOption(data) {
    var select = document.getElementById("cboServicio");
    data.forEach(function (dt) {
        var option = document.createElement("option"); // Crea un elemento option
        option.text = dt.nombre; // Establece el texto de la opción
        option.value = dt.id; // Opcional: puedes establecer un valor para la opción
        select.add(option); // Agrega la opción al select
    });
}

function getValorUnitarioServicio() {
    var select = document.getElementById("cboServicio");
    selectedServicioId = select.value

    var selectedServicio = servicios.find(function (s) {
        //console.log(salon.id)
        return s.id == selectedServicioId;
    });

    document.getElementById("txtValorServicio").value = selectedServicio.valor
}

function calcularServicio() {
    var cantidad = parseFloat(document.getElementById("txtCantidadSerivicio").value);
    var valor = parseFloat(document.getElementById("txtValorServicio").value);

    // Verificar si la cantidad y el valor son números válidos
    if (!isNaN(cantidad) && !isNaN(valor)) {
        var total = cantidad * valor;
        document.getElementById("txtTotalServicio").value = total.toFixed(2); // Para redondear a 2 decimales
    } else {
        alert("Ingrese valores numéricos válidos para cantidad y valor.");
    }
}

var seriviciosOrden = []
function agregarServicio() {
    var nombre = document.getElementById("cboServicio").value;
    var dia = parseFloat(document.getElementById("txtDiaServicio").value);
    var cantidad = parseFloat(document.getElementById("txtCantidadSerivicio").value);
    var valor = parseFloat(document.getElementById("txtValorServicio").value);
    var total = parseFloat(document.getElementById("txtTotalServicio").value);
    var selectedServicio = servicios.find(function (s) {
        //console.log(salon.id)
        return s.id == nombre;
    });
    var nuevoServicio = {
        nombre: nombre + "-" + selectedServicio.nombre,
        dia: dia,
        cantidad: cantidad,
        valor: valor,
        total: total
    };
    seriviciosOrden.push(nuevoServicio);

    actualizarServicios()
    calcularTotales()

}

function actualizarServicios() {
    var tablaServicio = document.getElementById("tablaServicio");
    var tbody = tablaServicio.querySelector("tbody");
    // Limpiar tbody antes de agregar las nuevas filas
    if (!tbody) {
        tbody = document.createElement("tbody");
        tablaSalones.appendChild(tbody);
    } else {
        tbody.innerHTML = "";
    }
    if (seriviciosOrden == null) {
        return
    }
    seriviciosOrden.forEach(function (s, index) {
        var fila = document.createElement("tr");

        // Crear celdas para cada propiedad del salón
        var nombreCell = document.createElement("td");
        nombreCell.textContent = s.nombre;
        fila.appendChild(nombreCell);

        var diaCell = document.createElement("td");
        diaCell.textContent = s.dia; // Suponiendo que 'dia' es una propiedad del salón
        fila.appendChild(diaCell);

        var cantidadCell = document.createElement("td");
        cantidadCell.textContent = s.cantidad;
        fila.appendChild(cantidadCell);

        var valorUnitarioCell = document.createElement("td");
        valorUnitarioCell.textContent = s.valor;
        fila.appendChild(valorUnitarioCell);

        var valorTotalCell = document.createElement("td");
        valorTotalCell.textContent = s.total;
        fila.appendChild(valorTotalCell);

        // Crear botón para eliminar fila
        var eliminarCell = document.createElement("td");
        var eliminarButton = document.createElement("button");
        eliminarButton.textContent = "Eliminar";
        eliminarButton.classList.add("btn", "btn-danger");
        eliminarButton.onclick = (function (i) {
            return function () {
                eliminarServicio(i);
            };
        })(index);
        eliminarCell.appendChild(eliminarButton);
        fila.appendChild(eliminarCell);
        // Agregar la fila a tbody
        tbody.appendChild(fila);
    });

    // Actualizar el subtotal en el pie de la tabla
    var subtotalCell = document.getElementById("subTotalServicios");
    var subtotal = seriviciosOrden.reduce(function (total, s) {
        return total + s.total;
    }, 0);

    subtotalCell.textContent = subtotal.toFixed(2);
}
function eliminarServicio(index) {
    console.log("indice " + index, seriviciosOrden);
    if (index > -1) {
        seriviciosOrden.splice(index, 1);
        console.log("Salón eliminado del array seriviciosOrden", seriviciosOrden);
        actualizarServicios();
    } else {
        console.error("Índice de servicio inválido");
    }
    calcularTotales()
}

function limpiarFormularioServicio() {
    document.getElementById("cboServicio").value = "";
    document.getElementById("txtDiaServicio").value = "0";
    document.getElementById("txtCantidadSerivicio").value = "0";
    document.getElementById("txtValorServicio").value = "0";
    document.getElementById("txtTotalServicio").value = "0";
}

/**gestión de otros Servicios */
var otros = null;
function findOtroServicios() {
    limpiarFormularioOtros()
    if (otros != null) {

        return
    }
    var options = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    };

    // Realizar la solicitud fetch
    fetch('/buscarOtroServicios', options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Respuesta del controlador:', data);
            otros = data[0].data
            console.log(otros)
            cargarOtrosOption(otros)

        })
        .catch(error => {
            console.error('Error al llamar al controlador:', error.message);
            swal("Error!", "En la consulta: " + error.message, "error");
        });
}

function cargarOtrosOption(data) {
    var select = document.getElementById("cboOtro");
    data.forEach(function (dt) {
        var option = document.createElement("option"); // Crea un elemento option
        option.text = dt.nombre; // Establece el texto de la opción
        option.value = dt.id; // Opcional: puedes establecer un valor para la opción
        select.add(option); // Agrega la opción al select
    });
}

function getValorUnitarioOtros() {
    var select = document.getElementById("cboOtro");
    selectedOtroId = select.value

    var selectedOtro = otros.find(function (o) {

        return o.id == selectedOtroId;
    });

    document.getElementById("txtValorOtro").value = selectedOtro.valor
}

function calcularOtro() {
    var cantidad = parseFloat(document.getElementById("txtCantidadOtro").value);
    var valor = parseFloat(document.getElementById("txtValorOtro").value);

    // Verificar si la cantidad y el valor son números válidos
    if (!isNaN(cantidad) && !isNaN(valor)) {
        var total = cantidad * valor;
        document.getElementById("txtTotalOtro").value = total.toFixed(2); // Para redondear a 2 decimales
    } else {
        alert("Ingrese valores numéricos válidos para cantidad y valor.");
    }
}

var otrosOrden = []
function agregarOtro() {
    var nombre = document.getElementById("cboOtro").value;
    var dia = parseFloat(document.getElementById("txtDiaOtro").value);
    var cantidad = parseFloat(document.getElementById("txtCantidadOtro").value);
    var valor = parseFloat(document.getElementById("txtValorOtro").value);
    var total = parseFloat(document.getElementById("txtTotalOtro").value);
    var selectedOtro = otros.find(function (o) {
        //console.log(salon.id)
        return o.id == nombre;
    });
    var nuevoOtro = {
        nombre: nombre + "-" + selectedOtro.nombre,
        dia: dia,
        cantidad: cantidad,
        valor: valor,
        total: total
    };
    otrosOrden.push(nuevoOtro);

    actualizarOtrosServicios()
    calcularTotales()

}

function actualizarOtrosServicios() {
    var tablaOtrosServicio = document.getElementById("tablaOtrosServicio");
    var tbody = tablaOtrosServicio.querySelector("tbody");
    // Limpiar tbody antes de agregar las nuevas filas
    if (!tbody) {
        tbody = document.createElement("tbody");
        tablaSalones.appendChild(tbody);
    } else {
        tbody.innerHTML = "";
    }
    if (otrosOrden == null) {
        return
    }
    otrosOrden.forEach(function (o, index) {
        var fila = document.createElement("tr");

        // Crear celdas para cada propiedad del salón
        var nombreCell = document.createElement("td");
        nombreCell.textContent = o.nombre;
        fila.appendChild(nombreCell);

        var diaCell = document.createElement("td");
        diaCell.textContent = o.dia; // Suponiendo que 'dia' es una propiedad del salón
        fila.appendChild(diaCell);

        var cantidadCell = document.createElement("td");
        cantidadCell.textContent = o.cantidad;
        fila.appendChild(cantidadCell);

        var valorUnitarioCell = document.createElement("td");
        valorUnitarioCell.textContent = o.valor;
        fila.appendChild(valorUnitarioCell);

        var valorTotalCell = document.createElement("td");
        valorTotalCell.textContent = o.total;
        fila.appendChild(valorTotalCell);

        // Crear botón para eliminar fila
        var eliminarCell = document.createElement("td");
        var eliminarButton = document.createElement("button");
        eliminarButton.textContent = "Eliminar";
        eliminarButton.classList.add("btn", "btn-danger");
        eliminarButton.onclick = (function (i) {
            return function () {
                eliminarOtrosServicio(i);
            };
        })(index);
        eliminarCell.appendChild(eliminarButton);
        fila.appendChild(eliminarCell);
        // Agregar la fila a tbody
        tbody.appendChild(fila);
    });

    // Actualizar el subtotal en el pie de la tabla
    var subtotalCell = document.getElementById("subTotalOtros");
    var subtotal = otrosOrden.reduce(function (total, o) {
        return total + o.total;
    }, 0);

    subtotalCell.textContent = subtotal.toFixed(2);
}
function eliminarOtrosServicio(index) {
    console.log("indice " + index, otrosOrden);
    if (index > -1) {
        otrosOrden.splice(index, 1);
        console.log("otro eliminado del array otrosOrden", otrosOrden);
        actualizarOtrosServicios();
    } else {
        console.error("Índice de otro servicio inválido");
    }
    calcularTotales()
}

function limpiarFormularioOtros() {
    document.getElementById("cboOtro").value = "";
    document.getElementById("txtDiaOtro").value = "0";
    document.getElementById("txtCantidadOtro").value = "0";
    document.getElementById("txtValorOtro").value = "0";
    document.getElementById("txtTotalOtro").value = "0";
}

var subTotalOrden=0
var deposito=0
var iva=0
var impuestoConsumo=0
var TotalOden=0

function calcularTotales() {
    var subtotalSalones = salonesOrden.reduce(function (total, sl) {
        return total + sl.total
    },0)

    var subtotalServicios = seriviciosOrden.reduce(function (total, s) {
        return total + s.total;
    }, 0);

    var subtotalOtros = otrosOrden.reduce(function (total, o) {
        return total + o.total;
    }, 0);
   
    subTotalOrden=subtotalOtros + subtotalSalones + subtotalServicios;
    console.log(subTotalOrden)
    var subTotalOrdenCell = document.getElementById("subTotalOrden");
    subTotalOrdenCell.textContent=subTotalOrden

    deposito=(subTotalOrden * 10)/100;
    var depositoCell = document.getElementById("deposito");
    depositoCell.textContent=deposito


    iva= (subTotalOrden * 19)/100;
    tipo=document.getElementById("cbTipo").value;
    if(tipo=="PA"){
        iva=0;
    }
    var ivaCell = document.getElementById("iva");
    ivaCell.textContent=iva

    
    var impuestoConsumoCell = document.getElementById("impuestoConsumo");
    impuestoConsumoCell.textContent=impuestoConsumo

    TotalOden=subTotalOrden + deposito + iva + impuestoConsumo;
    var TotalOdenCell = document.getElementById("TotalOden");
    TotalOdenCell.textContent=TotalOden

}

function guardarOrden(){
    var txtFechaEvento = document.getElementById("txtFechaEvento");
    var txtIdCliente = document.getElementById("txtIdCliente").value;
    var dt=txtIdCliente.split('-');
    var idCliente=parseInt(dt[0]);
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
    var data = {
        numeroOrden: null,
        fechaEvento: txtFechaEvento.value,
        idCliente: idCliente,
        idUsuario: null,
        subTotal: subTotalOrden,
        deposito: deposito,
        iva: iva,
        impuestoConsumo: impuestoConsumo,
        total: TotalOden,
        detalleSalon: salonesOrden,
        detalleServicio: seriviciosOrden,
        detalleOtro: otrosOrden,
        estado:1
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
    fetch('/guardarOrden', options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Respuesta del controlador:', data[0]);
            document.getElementById("txtOrdenServicio").value=data[0].data.numeroOrden;
            swal("Good job!", "Se creo orden de servicio "+ data[0].data.numeroOrden, "success");
        })
        .catch(error => {
            console.log(error)
            console.error('Error al llamar al controlador:', error);
            swal("Error!", "No al crear el orden de servicio: "+error.message, "error");
        });
}

function generarPDF() {
    
    // Load your docx template
    var template = "path/to/your/template.docx";
            
    // Data to fill in the template
    var data = {
        name: "John Doe",
        age: 30,
        country: "USA"
    };

    // Load the docx template
    var xhr = new XMLHttpRequest();
    xhr.open('GET', template, true);
    xhr.responseType = 'arraybuffer';

    xhr.onload = function () {
        var dataBuffer = new Uint8Array(xhr.response);
        var doc = new Docxtemplater();
        doc.loadZip(dataBuffer);

        // Set the data into the template
        doc.setData(data);

        try {
            // Render the document (replace the variables with data)
            doc.render();
            // Get the generated document as a blob
            var outputBlob = doc.getZip().generate({type: 'blob'});
            // Download the generated document
            saveAs(outputBlob, 'generated_document.docx');
        } catch (error) {
            console.log(error);
        }
    };

    xhr.send();
}