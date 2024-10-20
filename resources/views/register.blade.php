<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
	<main>
		<form method="POST" action="{{route('validar-registro')}}">
			@csrf
			<section class="vh-100" style="background: linear-gradient(to bottom, #007BFF, #00D2D3);">
				<div class="container py-5 h-100">
				<div class="row d-flex justify-content-center align-items-center h-100">
					<div class="col-12 col-md-8 col-lg-6 col-xl-5">
					<div class="card shadow-2-strong" style="border-radius: 1rem; background: #edf6fb;">
						<div class="card-body p-5">

						<h1 class="">Regístrate</h1>
						<br>

						<div class="input-group mb-4">
							<span class="input-group-text">
								<i class="fa-solid fa-user"></i>
							</span>
							<input style="font-size: 17px" placeholder="Nombre de usuario" type="text" class="form-control" id="userInput" name="name" required autocomplete="disable">
							@error('name')
								<div style="color: red;">{{ $message }}</div>
							@enderror
						</div>

						<div class="input-group mb-4">
							<span class="input-group-text">
								<i class="fa-solid fa-envelope"></i>
							</span>
							<input style="font-size: 17px" placeholder="Ingresa tu correo" type="email" class="form-control" id="emailInput" name="email" required />
							<br>
							@error('email')
								<div style="color: red;">{{ $message }}</div>
							@enderror
							<br>
						</div>


						<div class="input-group mb-4">
							<span class="input-group-text">
								<i class="fa-solid fa-lock"></i>
							</span>
							<input style="font-size: 17px" placeholder="Contraseña" type="password" class="form-control" id="passwordInput" name="password" required>
							@error('password')
								<div style="color: red;">{{ $message }}</div>
							@enderror
						</div>

						<button type="submit" class="btn btn-lg btn-primary w-100">Registrarse</button>
						<p class="fs-5 mt-3">
							<a href="{{route('login')}}">Ya tengo cuenta</a>
						</p>
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

