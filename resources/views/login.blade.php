<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<main>
		<form method="POST" action="{{route('inicia-sesion')}}">
			@csrf   
      <section class="vh-100" style="background: linear-gradient(to bottom, #e60120, #f16676);">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem; background: white;">
                <div class="card-body p-5" >
                  <div style="display:flex; justify-content: center; align-items: center;">
                  <img src="{{ asset('img/OKSO.png') }}" style="width:200px; height:100px; margin-bottom: 1em;" >
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
                    <span class="input-group-text">
                      <i style="position: relative; width: fit-content; display: flex; align-items: center; margin-left: 0.2em;" class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                    </span>
                  </div>
                    <script>
                      const togglePassword = document.querySelector("#togglePassword");
                      const password = document.querySelector("#passwordInput");

                      togglePassword.addEventListener("click", function () {
                          const type = password.getAttribute("type") === "password" ? "text" : "password";
                          password.setAttribute("type", type);
                          this.classList.toggle("fa-eye-slash");
                      });

                    </script>
                  
                  
                  @error('user')
                    <div style="color: red;">{{ $message }}</div>
                  @enderror

                  <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg w-100" type="submit" style="background:#fab110; border: 0.5px solid #fab110;">Ingresar</button>
                  
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