<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css'>
</head>
<body>
<main>
		<form method="POST" action="{{route('inicia-sesion')}}">
			@csrf   
      <section class="vh-100" style="background: linear-gradient(to bottom, #007BFF, #00D2D3);">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem; background: white;">
                <div class="card-body p-5" >
                  <div style="color:#007BFF; display:flex; font-size:30px; justify-content: center; align-items: center;">
                    <i class="fi fi-rs-messages"></i>
                    <h1 class="" style="margin-left:10px; margin-bottom:10px;">Iniciar sesión</h1>
                    <br>
                  </div>
                  

                    <div class="input-group mb-4">
                    <span class="input-group-text">
                      <i class="fa-solid fa-user"></i>
                    </span>
                    <input style="font-size: 17px" placeholder="Ingresa tu usuario" type="text" class="form-control" id="usernameInput" name="user" required />
                    <br>
                    </div>


                  <div class="input-group mb-4">
                    <span class="input-group-text">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input style="font-size: 17px" placeholder="Contraseña" type="password" class="form-control" id="passwordInput" name="password" required>
                  </div>
                  @error('user')
                    <div style="color: red;">{{ $message }}</div>
                  @enderror

                  <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg w-100" type="submit">Ingresar</button>
                  <p class="text-center fs-5 mt-3">¿No tienes cuenta? 
                    <a href="{{route('registro')}}">Regístrate</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </form>
</main>
</body>
<script src="https://kit.fontawesome.com/03bac4e256.js" crossorigin="anonymous"></script>
</html>