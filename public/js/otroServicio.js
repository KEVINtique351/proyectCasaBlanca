function guardar(){
    txtId=document.getElementById("id").value;
    txtNombre=document.getElementById("nombre").value;
    txtValor=document.getElementById("valor").value;
    validarCampos(txtNombre,txtValor)
    if(!validarCampos){
        alert("los campos no pueden estar vacios")
    }
    if(txtId.trim() === ""){
        nuevoServicio(txtNombre,txtValor)
    }else{
        actualizaRegistro(txtId,txtNombre,txtValor)
    }
    limpiar()
}

function nuevoServicio(nombre,valor){
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
    // Objeto con los datos a enviar
    var data = {
        nombre: nombre,
        valor: valor
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
    fetch('/guardarOtroServicio', options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Respuesta del controlador:', data);
            swal("Good job!", "Se registro el nuevo servicio", "success");
        })
        .catch(error => {
            console.error('Error al llamar al controlador:', error.message);
            swal("Error!", "No guardo el servicio: "+error.message, "error");
        });
}

function actualizaRegistro(id,nombre,valor){
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
    // Objeto con los datos a enviar
   var data = {
    id: id,
    nombre: nombre,
    valor: valor
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
fetch('/actualizarOtroServicio', options)
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

function validarCampos(nombre,valor){
    respuesta=true
    if (nombre.trim() === "") {
        respuesta=false
    }
    if (valor.trim() === "") {
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
    var url = '/getOtroServicio/' + encodeURIComponent(parametro);

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
    fetch('/buscarOtroServicios', options)
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
           data.forEach(servicio => {
                console.log(servicio)
                const row = `
                    <tr>
                        <td>${servicio.id}</td>
                        <td>${servicio.nombre}</td>
                        <td>${servicio.valor}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick='cargarDatos(${JSON.stringify(servicio)})'>
                                    <span class="material-symbols-outlined">edit_square</span>
                                </button>
                                <button class="btn btn-danger" onclick='eliminarDatos(${JSON.stringify(servicio)})'>
                                    <span class="material-symbols-outlined">delete</span>
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
    document.getElementById("nombre").value = data.nombre;
    document.getElementById("valor").value = data.valor;
}

function eliminarDatos(data){
    swal({
        title: "Are you sure?",
        text: "Se eliminará el registro "+data.nombre,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            eliminar(data.id);
          /*swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
          });*/
        } else {
          //swal("Your imaginary file is safe!");
        }
      });
}

function eliminar(id){
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
    var url = '/deleteOtrServicio/' + encodeURIComponent(id);

    var options = {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
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
            //cargarTabla(data[0].data)
            swal("Good job!", "se eliminó el servicio ", "success");
        })
        .catch(error => {
            console.error('Error al llamar al controlador:', error.message);
            swal("Error!", "En la eliminación: "+error.message, "error");
        });
}

function limpiar(){
    document.getElementById("id").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("valor").value = "";
}