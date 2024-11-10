<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css'>
</head>
<body>
	<main>
		<form method="POST" action="{{route('validar-registro')}}">
			@csrf
			<section class="vh-100" style="background: linear-gradient(to bottom, #007BFF, #00D2D3);">
				<div class="container py-5 h-100">
				<div class="row d-flex justify-content-center align-items-center h-100">
					<div class="col-12 col-md-8 col-lg-6 col-xl-5">
					<div class="card shadow-2-strong" style="border-radius: 1rem; background: white;">
						<div class="card-body p-5">

						<div style="color:#007BFF; display:flex; font-size:30px; justify-content: center; align-items: center;">
							<i class="fi fi-rs-messages"></i>
							<h1 class="" style="margin-left:10px; margin-bottom:10px;">Regístrate</h1>
							<br>
						</div>
						<div class="input-group mb-4">
							<span class="input-group-text">
								<i class="fa-solid fa-user"></i>
							</span>
							<input style="font-size: 17px" placeholder="Usuario" type="text" class="form-control" id="userInput" name="user" required autocomplete="disable">
							@error('name')
								<div style="color: red;">{{ $message }}</div>
							@enderror
						</div>

						<div class="input-group mb-4">
							<input style="font-size: 17px; width: 50%;" placeholder="Nombre" type="text" class="form-control" id="nameInput" name="name" required autocomplete="disable">
							<input style="font-size: 17px; width: 50%;" placeholder="Apellido" type="text" class="form-control" id="lastnameInput" name="lastname" required autocomplete="disable">
						</div>

						<div class="input-group mb-4">
							<span class="input-group-text">
								<i class="fa-solid fa-phone"></i>
							</span>
							<input style="font-size: 17px" placeholder="Número de teléfono" class="form-control" id="phoneInput" name="phonenumber" required />
							<br>

							<br>
						</div>

						<div class="input-group mb-4">
							<span class="input-group-text">
								<i class="fa-solid fa-calendar"></i>
							</span>
							<input style="font-size: 17px" placeholder="Fecha de nacimiento" type="date" class="form-control" id="birthdateInput" name="birthdate" required>
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
						<div style="display: flex; justify-content: center; align-items: center; background-color: #white; padding: 5px; border-radius: 5px;">
							<p class="fs-5 mt-3">
								<a href="{{route('login')}}" style="color: #007BFF;">Ya tengo cuenta</a>
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

