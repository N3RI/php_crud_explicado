<!doctype html>
<html lang="es">

<head>
	<title>CRUD PHP EXPLICADO</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
	<!-- Bootstrap CSS v5.3.2 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="./css/style.css">
</head>

<body>
	<header>
		<!-- place navbar here -->
	</header>
	<main>
		<div class="container">
			<div class="row justify-content-center align-items-center g-2">
				<div class="col">
					<h1>CRUD PHP EXPLICADO</h1>
				</div>
			</div>
		</div>

		<div class="container my-2 shadow">
			<div class="row justify-content-center align-items-center g-2">
				<div class="col">
					<!-- Formulario para crear un usuario -->
					<h2>Crear Usuario</h2>
					<form action="crud.php" method="post" class="row g-3 mb-3">
						<div class="col">
							<label for="apellido" class="form-label">Apellido:</label>
							<input type="text" name="apellido" id="apellido" class="form-control" required>
						</div>
						<div class="col">
							<label for="nombre" class="form-label">Nombre:</label>
							<input type="text" name="nombre" id="nombre" class="form-control" required>
						</div>
						<div class="col">
							<label for="email" class="form-label">Correo Electrónico:</label>
							<input type="email" name="email" id="email" class="form-control" required>
						</div>
							<input type="submit" name="create" value="Create">
					</form>
				</div>
			</div>
		</div>

		<div class="container my-2 shadow">
			<div class="row justify-content-center align-items-center g-2">
				<div class="col">
					<!-- Formulario para leer usuarios -->
					<h2>Leer Usuarios</h2>
					<form action="crud.php" method="post" class="row g-3 mb-3">
						<input type="submit" name="read" value="Read">
					</form>
				</div>
			</div>
		</div>

		<div class="container mb-2 shadow">
			<div class="row justify-content-center align-items-center g-2">
				<div class="col">
					<!-- Formulario para actualizar un usuario -->
					<h2>Actualizar Usuario</h2>
					<form action="crud.php" method="post" class="row g-3 mb-3">
					<div class="col">
						<label for="id_update" class="form-label">ID de Usuario:</label>
						<input type="number" name="id" id="id_update" class="form-control" required>
					</div>
					<div class="col">
						<label for="nuevo_nombre" class="form-label">Nuevo Nombre:</label>
						<input type="text" name="nuevo_nombre" id="nuevo_nombre" class="form-control" required>
					</div>
						<input type="submit" name="update" value="Update">
					</form>
				</div>
			</div>
		</div>

		<div class="container my-2 shadow">
			<div class="row justify-content-center align-items-center g-2">
				<div class="col">
					<!-- Formulario para eliminar un usuario -->
					<h2>Eliminar Usuario</h2>
					<form action="crud.php" method="post" class="row g-3 mb-3">
						<div class="col">
							<label for="id_delete" class="form-label">ID de Usuario:</label>
							<input type="number" name="id" id="id_delete" class="form-control" required>
						</div>
							<input type="submit" name="delete" value="Delete">
					</form>
				</div>
			</div>
		</div>





	</main>
	<footer>
		<!-- place footer here -->
	</footer>
	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>