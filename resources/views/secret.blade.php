<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mensajes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>
<body class="vh-100" style="background: linear-gradient(to bottom, #007BFF, #00D2D3);">
    
    <div class="todo" style="background:white; padding:10px; margin-left:70px; margin-right:70px;  margin-top:20px;  margin-bottom:0px; border-radius:20px;">
         
        <div class="container">
            <header style="display: flex; justify-content: space-between; align-items: center; height: 100px; padding: 0 20px;">
                <div style="display: flex; align-items: center;">
                    <i class="fi fi-rr-portrait" style="margin-right: 10px; color: #0D6EFD; font-size: 25px;"></i>    
                    <a style="color: #0D6EFD; font-size: 25px;">
                        @auth {{ Auth::user()->name }} @endauth
                    </a>
                </div>

                <div style="display: flex; justify-content: center; align-items: center; font-size: 40px; color: #007BFF; -webkit-background-clip: text;">
                    <i class="fi fi-rs-messages"></i> 
                    <h1 style="margin-left: 5px;">MENSAJES</h1>
                </div>

                <div style="text-align: right;">
                    <a href="{{ route('logout') }}">
                        <button type="button" class="btn btn-outline-primary" style="margin-right: 3px;">Salir <i class="fi fi-rs-exit"></i></button>
                    </a>
                </div>
            </header>


            <article class="container">
                <h4 style="color:#00A8E6;">TABLA DE MENSAJES</h3>
                <div style="max-height: 250px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Mensaje</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mensajes as $mensaje)
                                <tr>
                                    <td  class="fw-semibold">{{ $mensaje->user->name }}</td>
                                    <td>{{ decrypt($mensaje->mensaje) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No se encontraron mensajes.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                

                <form method="POST" action="{{ route('mensajes.store') }}">
                    @csrf
                    <h4 for="mensaje" class="form-label" style="color:#00A8E6; margin-top:10px">NUEVO MENSAJE</h4>
                    <div class="" style="display:flex;">
                        
                        <textarea class="form-control" id="mensaje" name="mensaje" placeholder="Escribe un mensaje..."  required style="margin-right:10px;"></textarea>
                        
                        <button type="submit" class="btn btn-primary">
                        <i class="fi fi-ss-paper-plane-top"></i>
                        </button>
                    </div>
                    @error('mensaje')
                    <div class="alert alert-danger" role="alert" style="margin-top:20px">
                        {{ $message }}
                    </div>
                    @enderror

                    
                </form>
            </article>
        </div>
    </div>
</body>
</html>
