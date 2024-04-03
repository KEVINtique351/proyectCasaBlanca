@extends('app')
@section('content')
@if(session('success'))
    <h1>{{session('success')}}</h1>
@endif   
             
<main class="login-form">
    <div class="contenedor">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-login">
                    <h3 class="card-header text-center">Casa Blancan</h3>
                    <div class="card-body">
                        <form method="POST" action="{{route('login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label id="lbUsuario" style="display: none">Usuario</label>
                                <input type="text" placeholder="Usuario" id="email" class="form-control" name="email" required
                                    autofocus onblur="gestionUsuario()">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label  id="lbPassword" style="display: none">Contraseña</label>
                                <input type="password" placeholder="Password" id="password" class="form-control" name="password" required onblur="gestionPassword()">
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Recuerdame
                                    </label>
                                </div>
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="{{ asset('js/login.js') }}" />
<script>
    // Llama a la función init() después de que todo el contenido de la página haya sido cargado
    document.addEventListener("DOMContentLoaded", function() {
        init();
    });
</script>
@endsection