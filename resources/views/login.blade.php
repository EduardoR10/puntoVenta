<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
<main>
		<form method="POST" action="{{route('inicia-sesion')}}">
			@csrf
      <section class="vh-100" style="background: linear-gradient(to bottom, #007BFF, #00D2D3);">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5">

                  <h2 class="">Inicia sesión</h2>
                  <br>

                  <div class="input-group mb-4">
                    <span class="input-group-text">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input placeholder="Ingresa tu Email" type="email" class="form-control" id="emailInput" name="email" required />
                    <br>
                  </div>


                  <div class="input-group mb-4">
                    <span class="input-group-text">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input placeholder="Password" type="password" class="form-control" id="passwordInput" name="password" required>
                  </div>

                  <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg w-100" type="submit">Login</button>
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