function guardar(){
    txtId=document.getElementById("id").value;
    txtNombre=document.getElementById("txtNombres").value;
    txtApellidos=document.getElementById("txtApellidos").value;
    txtTipo=document.getElementById("cbTipo").value;
    txtNumero=document.getElementById("txtNumero").value;
    txtDireccion=document.getElementById("txtDireccion").value;
    txtEmail=document.getElementById("txtEmail").value;
    txtContacto=document.getElementById("txtContacto").value;
    validarCampos(txtNombre,txtApellidos,txtTipo,txtNumero,txtDireccion,txtEmail,txtContacto)
    if(!validarCampos){
        alert("los campos no pueden estar vacios")
    }
    if(txtId.trim() === ""){
        nuevoServicio(txtNombre,txtApellidos,txtTipo,txtNumero,txtDireccion,txtEmail,txtContacto)
    }else{
        actualizaRegistro(txtId,txtNombre,txtApellidos,txtTipo,txtNumero,txtDireccion,txtEmail,txtContacto)
    }
    limpiar()
}

function nuevoServicio(txtNombre,txtApellidos,txtTipo,txtNumero,txtDireccion,txtEmail,txtContacto){
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
    // Objeto con los datos a enviar
    var data = {
        nombres: txtNombre,
        apellidos: txtApellidos,
        tipoIdentificacion: txtTipo,
        identificacion: txtNumero,
        direccion: txtDireccion,
        email: txtEmail,
        contacto: txtContacto
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
    fetch('/guardarCliente', options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Respuesta del controlador:', data);
            swal("Good job!", "Se registro el nuevo Cliente", "success");
        })
        .catch(error => {
            console.error('Error al llamar al controlador:', error.message);
            swal("Error!", "No guardo el Cliente: "+error.message, "error");
        });
}

function actualizaRegistro(id,txtNombre,txtApellidos,txtTipo,txtNumero,txtDireccion,txtEmail,txtContacto){
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
    // Objeto con los datos a enviar
   var data = {
    id: id,
    nombres: txtNombre,
        apellidos: txtApellidos,
        tipoIdentificacion: txtTipo,
        identificacion: txtNumero,
        direccion: txtDireccion,
        email: txtEmail,
        contacto: txtContacto
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
fetch('/actualizarCliente', options)
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la solicitud: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log('Respuesta del controlador:', data);
        swal("Good job!", "Se guardo servicio", "success");
    })
    .catch(error => {
        console.error('Error al llamar al controlador:', error.message);
        swal("Error!", "No guardo el servicio: "+error.message, "danger");
    });
}

function validarCampos(txtNombre,txtApellidos,txtTipo,txtNumero,txtDireccion,txtEmail,txtContacto){
    respuesta=true
    if (txtNombre.trim() === "") {
        respuesta=false
    }
    if (txtApellidos.trim() === "") {
        respuesta=false
    }
    if (txtTipo.trim() === "") {
        respuesta=false
    }
    if (txtNumero.trim() === "") {
        respuesta=false
    }
    if (txtDireccion.trim() === "") {
        respuesta=false
    }
    if (txtEmail.trim() === "") {
        respuesta=false
    }
    if (txtContacto.trim() === "") {
        respuesta=false
    }
    return respuesta
}

function buscar(){
    parametro=document.getElementById("txtParametro").value;
    if (parametro.trim() === "") {
        findAll()
    }else{
        findByParametro(parametro)
    }
}

function findByParametro(parametro){
    var url = '/getClienteByNombre/' + encodeURIComponent(parametro);

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
            swal("Error!", "En la consulta: "+error.message, "error");
        });
}

function findAll(){
    var options = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    };

    // Realizar la solicitud fetch
    fetch('/getCliente', options)
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
            swal("Error!", "En la consulta: "+error.message, "error");
        });
}

function cargarTabla(data){
    const tbody = document.querySelector('.table-group-divider');
            tbody.innerHTML = '';

            // Llenar la tabla con los datos recibidos
           data.forEach(cliente => {
             
                const row = `
                    <tr>
                        <td>${cliente.id}</td>
                        <td>${cliente.nombres} ${cliente.apellidos}</td>
                        <td>${cliente.tipoIdentificacion} ${cliente.identificacion}</td>
                        <td>${cliente.direccion}</td>
                        <td>${cliente.email}</td>
                        <td>${cliente.contacto}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick='cargarDatos(${JSON.stringify(cliente)})'>
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
    document.getElementById("txtNombres").value = data.nombres;
    document.getElementById("txtApellidos").value= data.apellidos;
    document.getElementById("cbTipo").value= data.tipoIdentificacion;
    document.getElementById("txtNumero").value= data.identificacion;
    document.getElementById("txtDireccion").value= data.direccion;
    document.getElementById("txtEmail").value= data.email;
    document.getElementById("txtContacto").value= data.contacto;
}





function limpiar(){
    document.getElementById("id").value = "";
    document.getElementById("txtNombres").value = "";
    document.getElementById("txtApellidos").value= "";
    document.getElementById("cbTipo").value= "";
    document.getElementById("txtNumero").value= "";
    document.getElementById("txtDireccion").value= "";
    document.getElementById("txtEmail").value= "";
    document.getElementById("txtContacto").value= "";
}