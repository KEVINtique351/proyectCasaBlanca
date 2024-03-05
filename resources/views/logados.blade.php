@extends('app')
@extends('topbar')
@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h1>FORMULARIO DE RESERVACIÓN</h1>

                    <form action="">
                        <label for="">Número de identificación</label>
                        <input type="text" name="" id="" onblur="buducarCliente()">

                        <label for="">Tipo de identificación</label>
                        <select name="" id="">
                            <option value="@">Seleccione...</option>
                            <option value="CC">Cedula de ciudadania</option>
                            <option value="CE">Cedula de extranjeria</option>
                            <option value="NIT">NIT</option>
                        </select>
                    </form>
                 </div>
            </div>
        </div>
    </div>
</main>

<script>
    function buducarCliente(){
        alert("hola soy onblur debo buscar un cliente")
    }
</script>
@endsection