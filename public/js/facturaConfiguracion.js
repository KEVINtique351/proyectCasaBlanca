function guardar() {
    txtId = document.getElementById("id").value;
    txtEstado = document.getElementById("cbEstado").value;
    txtResolucion = document.getElementById("txtResolucion").value;
    txtFacturaInicial = document.getElementById("txtFacturaInicial").value;
    txtFacturaFinal = document.getElementById("txtFacturaFinal").value;
    txtFactura = document.getElementById("txtFactura").value;

    validarCampos(txtEstado, txtResolucion, txtFacturaInicial, txtFacturaFinal, txtFactura)
    if (!validarCampos) {
        alert("los campos no pueden estar vacios")
    }
    if (txtId.trim() === "") {
        nuevoServicio(txtEstado, txtResolucion, txtFacturaInicial, txtFacturaFinal, txtFactura)
    } else {
        actualizaRegistro(txtId, txtEstado, txtResolucion, txtFacturaInicial, txtFacturaFinal, txtFactura)
    }
    limpiar()
}

function nuevoServicio(txtEstado, txtResolucion, txtFacturaInicial, txtFacturaFinal, txtFactura) {
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Objeto con los datos a enviar
    var data = {
        estado: txtEstado,
        resolucion: txtResolucion,
        facturaInicia: txtFacturaInicial,
        facturaFinal: txtFacturaFinal,
        numero: txtFactura
    };

    // Opciones para la solicitud fetch
    var options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify(data)
    };

    // Realizar la solicitud fetch
    fetch('/guardarFacturaConfiguracion', options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Respuesta del controlador:', data);
            swal("Good job!", "Se registro el nuevo Resolución de Facturas", "success");
        })
        .catch(error => {
            console.error('Error al llamar al controlador:', error.message);
            swal("Error!", "No guardo la Resolución de Facturas: " + error.message, "error");
        });
}

function actualizaRegistro(id, txtEstado, txtResolucion, txtFacturaInicial, txtFacturaFinal, txtFactura) {
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Objeto con los datos a enviar
    var data = {
        id: id,
        estado: txtEstado,
        resolucion: txtResolucion,
        facturaInicia: txtFacturaInicial,
        facturaFinal: txtFacturaFinal,
        numero: txtFactura
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
            swal("Error!", "No guardo la Resolución: " + error.message, "danger");
        });
}

function validarCampos(txtEstado, txtResolucion, txtFacturaInicial, txtFacturaFinal, txtFactura) {
    respuesta = true
    if (txtEstado.trim() === "") {
        respuesta = false
    }
    if (txtResolucion.trim() === "") {
        respuesta = false
    }
    if (txtFacturaInicial.trim() === "") {
        respuesta = false
    }
    if (txtFacturaFinal.trim() === "") {
        respuesta = false
    }
    if (txtFactura.trim() === "") {
        respuesta = false
    }
    
    return respuesta
}

function buscar() {
    parametro = document.getElementById("txtParametro").value;
    if (parametro.trim() === "@") {
        findAll()
    } else {
        findByParametro(parametro)
    }
}

function findByParametro(parametro) {
    var url = '/getResolucion/' + encodeURIComponent(parametro);

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
            cargarTabla(data[0].data)

        })
        .catch(error => {
            console.error('Error al llamar al controlador:', error.message);
            swal("Error!", "En la consulta: " + error.message, "error");
        });
}

function findAll() {
    var options = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    };

    // Realizar la solicitud fetch
    fetch('/buscarResoluciones', options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Respuesta del controlador:', data);
            cargarTabla(data[0].data)

        })
        .catch(error => {
            console.error('Error al llamar al controlador:', error.message);
            swal("Error!", "En la consulta: " + error.message, "error");
        });
}

function cargarTabla(data) {
    const tbody = document.querySelector('.table-group-divider');
    tbody.innerHTML = '';

    // Llenar la tabla con los datos recibidos
    data.forEach(resolucion => {

        const row = `
                    <tr>
                        <td>${resolucion.id}</td>
                        <td>${resolucion.resolucion}</td>
                        <td>${resolucion.facturaInicia}</td>
                        <td>${resolucion.facturaFinal}</td>
                        <td>${resolucion.numero}</td>
                        <td>${resolucion.estado}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick='cargarDatos(${JSON.stringify(resolucion)})'>
                                    <span class="material-symbols-outlined">edit_square</span>
                                </button>
                                
                            </div>
                        </td>
                    </tr>
                `;
        tbody.insertAdjacentHTML('beforeend', row);
    });
}

function cargarDatos(data) {
    document.getElementById("id").value = data.id;
    document.getElementById("cbEstado").value = data.estado;
    document.getElementById("txtResolucion").value = data.resolucion;
    document.getElementById("txtFacturaInicial").value = data.facturaInicia;
    document.getElementById("txtFacturaFinal").value = data.facturaFinal;
    document.getElementById("txtFactura").value = data.numero;
}





function limpiar() {
    document.getElementById("id").value = "";
    document.getElementById("cbEstado").value = "";
    document.getElementById("txtResolucion").value = "";
    document.getElementById("txtFacturaInicial").value = "";
    document.getElementById("txtFacturaFinal").value = "";
    document.getElementById("txtFactura").value = "";
}