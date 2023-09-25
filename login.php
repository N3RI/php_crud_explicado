<?php
	// Include config file
	require_once "config/config.php";

	// Inicializo la sesión
	session_start();
 
	// Chequeo si el usuario ya está logueado, y lo mando a la página de inicio
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		header("location: index.php");
		exit;
	}
 
	// Defino variables que voy a utilizar y las inicializo vacías
	$username = $password = "";
	$username_err = $password_err = "";
	$tipo_usuario = ""; // tipo_usuario 1=admin 2=editor 3=supervisor
	
	// Proceso los datos enviados cuando el formulario es enviado
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		// Chequeo si el usuario está vacío
		if(empty(trim($_POST["username"]))){
			$username_err = "Por favor ingresa tu nombre de usuario.";
		} else{
			$username = trim($_POST["username"]);
		}

		// Chequeo si el password está vacío
		if(empty(trim($_POST["password"]))){
			$password_err = "Por favor ingresa tu contraseña.";
		} else{
			$password = trim($_POST["password"]);
		}

		// Valido las credenciales
		if(empty($username_err) && empty($password_err)){
				// Preparo una sentencia select
				$sql = "SELECT id_usuario, usuario, contrasenia, tipo FROM usuarios WHERE usuario = ?";

			if($stmt = mysqli_prepare($link, $sql)){
				// Vinculo las variables a las sentencias preparadas como parámeptros
				mysqli_stmt_bind_param($stmt, "s", $param_username);

				// Seteo los parámetros
				$param_username = $username;

				// Intento ejecutar la sentencia preparada
				if(mysqli_stmt_execute($stmt)){
					// Guardo los resultados
					mysqli_stmt_store_result($stmt);

					// Chequeo si existe el username, si existe, entonces verifico el password
					if(mysqli_stmt_num_rows($stmt) == 1){	// solo puede existir 1 usuario, ni 0 ni 2									
						// Vinculo las variables resultantes
						mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $tipo_usuario);
						if(mysqli_stmt_fetch($stmt)){
							if(password_verify($password, $hashed_password)){
								// Password es correcto, entonces inicio una nueva sesión
								if(!isset($_SESSION)){ 
									session_start(); 
								}
								
								// Guardo los datos en variables de Sesión
								$_SESSION["loggedin"] = true;
								$_SESSION["id"] = $id;
								$_SESSION["username"] = $username;														
								$_SESSION["tipo"] = $tipo_usuario;

								// Redirijo a la página de inicio
								header("location: index.php");
							} else{
								// Si el password es incorrecto muestro un mensaje de error
								$password_err = "La contraseña ingresada es incorrecta.";
							}
						}
					} else{
						// Si el usuario no existe, muestro un mensaje de error
						$username_err = "No existe ese usuario.";
					}
				} else{
					echo "Oops! Ocurrió un error. Intenta de nuevo más tarde.";
				}

				// Close statement
				mysqli_stmt_close($stmt);
			}
		}
		
		// Close connection
		mysqli_close($link);
	} 
?> 

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sitio | Iniciar Sesión</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="img/favicon.png">
		<!-- Bootstrap CSS v5.3.2 -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="./css/style.css">

</head>

<body class="">
<div class="container-fluid d-flex justify-content-center">
	<div class="mx-auto">
	<div class="login-logo">
		<a href="index.php"><img class="mb-4" src="img/logo.png" alt="Sitio"></a>
	</div>
	<!-- /.login-logo -->
	<div class="card mx-auto">
		<div class="card-body">
			<p class="login-box-msg">Inicie Sesión</p>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<div class="input-group mb-3 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
					<input type="text" name="username" maxlength="50" class="form-control" placeholder="Usuario"	value="<?php echo $username; ?>">
					<div class="input-group-prepend">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
					<div>
					</div>
				</div>
				<div class="input-group mb-3	<?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
					<input type="password" name="password" class="form-control" placeholder="Contraseña">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<span class="help-block text-danger"><?php echo $username_err; ?></span>
				<span class="help-block text-danger"><?php echo $password_err; ?></span>
				<div class="row">
					<div class="col-4">
						<button type="submit" class="btn btn-danger btn-block">Entrar</button>
					</div>
					<!-- /.col -->
				</div>
			</form>
		</div>
		<!-- /.login-card-body -->
	</div>
</div>
<!-- /.login-box -->
</div>

	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
