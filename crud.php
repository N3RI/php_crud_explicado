<?php
// Esta versión del CRUD es más completa y más segura, evita hackeos y errores
// Utilizamos "Declaraciones preparadas" con marcadores (?) para realizar de manera segura las operaciones de inserción, actualización y eliminación de datos.
// Validamos la entrada de datos mediante funciones de PHP como filter_var() y empty() para asegurarnos de que los datos tengan el formato esperado y no estén vacíos.
// Comprobamos el método de solicitud ($_SERVER["REQUEST_METHOD"]) para determinar si se envió un formulario mediante POST antes de procesar la operación CRUD correspondiente.
// Vinculamos parámetros a las "declaraciones preparadas" utilizando bind_param() para garantizar que la entrada del usuario se trate como datos y no como código SQL ejecutable.
// Manejamos los errores de manera adecuada y proporcionamos mensajes de error apropiados.

// A diferencia del CRUD Simple, la conexión a la base de datos no la hacemos en cada archivo, sino que la hacemos en un archivo config.php que incluiremos
include("config/config.php");

// Declaramos las variables que vamos a usar para que no nos de error de variable no declarada.
$id = "";
$id_eliminar = "";
$nuevo_apellido = "";
$nuevo_nombre = "";
$nuevo_email = "";

// El código php lo ponemos antes del código html. Para poder chequear qué botón se apretó y completar el formulario correspondiente

// Si apreté botón Create (Insertar) --------------------------------------------------------------
// isset() verifica si apreté botón cuyo name="Create" (Insertar)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["create"])) {
	// tomo las variables que el formulario Create envió por POST
	$apellido = $_POST["apellido"];
	$nombre = $_POST["nombre"];
	$email = $_POST["email"];

	// Validar la entrada (puedes agregar más validaciones según sea necesario)
	// filter_var() valida que el email sea válido
	if (!empty($nombre) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

		// Crear una "Declaración Preparada"
		$stmt = $conexion->prepare("INSERT INTO usuarios (apellido, nombre, email) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $apellido, $nombre, $email);
		// La cantidad y el orden de signos ? debe ser la misma que las s del bind_param
		// s para variables de tipo string (varchar)
		// i para variables de tipo entero (int) 
		// d para variables de tipo decimal (float)	
		// para fechas se usa s, pero debe coincidir el formato a date: "YYYY-MM-DD", sino causa errores

		// Ejecutar la declaración preparada
		if ($stmt->execute()) {
			echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
					Registro creado con éxito.
					<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
					</div>";
		} else {
			echo "Error: " . $stmt->error;
		}

		// Cerrar la conexión a la base de datos
		$stmt->close();
	} else {
		echo "Datos de entrada inválidos.";
	}
}
// Fin del if POST Create -------------------------------------------------------------------------

// Si apreté botón Actualizar ---------------------------------------------------------------------
// El botón Actualizar no actualiza los datos a la base de datos, sino que baja los datos para completar el formulario Update, que es el que realmente actualiza la BD 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["actualizar"])) {
	$id = $_POST["id"];

	$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id=?");
	$stmt->bind_param("i", $id);

	// Ejecutar la declaración preparada
	// Bajo los datos de la DB y guardo los datos en las "$nuevas_variables" 
	if ($stmt->execute()) {
		$stmt->bind_result($id, $nuevo_apellido, $nuevo_nombre, $nuevo_email);
		while ($stmt->fetch()) {
		}
	} else {
		echo "Error: " . $stmt->error;
	}
}
// Fin del if POST Actualizar ---------------------------------------------------------------------

// Si aprieto el botón Update ---------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"])) {
	// tomo los valores que modificó el usuario en el formulario del Update
	$id = $_POST["id"];
	$nuevo_apellido = $_POST["nuevo_apellido"];
	$nuevo_nombre = $_POST["nuevo_nombre"];
	$nuevo_email = $_POST["nuevo_email"];

	// Validar la entrada
	if (!empty($id) && !empty($nuevo_apellido) && !empty($nuevo_nombre) && !empty($nuevo_email)) {
		// Crear una declaración preparada
		$stmt = $conexion->prepare("UPDATE usuarios SET apellido=?, nombre=?, email=? WHERE id=?");
		$stmt->bind_param("sssi", $nuevo_apellido, $nuevo_nombre, $nuevo_email, $id);
		// sssi porque tengo 3 string (varchar) y 1 id de tipo entero (int)

		// Ejecutar la declaración preparada
		if ($stmt->execute()) {
			echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
					Registro actualizado con éxito.
					<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
					</div>";
		} else {
			echo "Error: " . $stmt->error;
		}

		// Cerrar la declaración preparada
		$stmt->close();
	} else {
		echo "Datos de entrada inválidos.";
	}
}
// Fin del if POST Update -------------------------------------------------------------------------

// si aprieto el botón Eliminar -------------------------------------------------------------------
// el botón Eliminar no elimina realmente, sólo guarda el $id_eliminar para autocompletar el formulario Delete, que realmente elimina de la DB
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["eliminar"])) {
	$id_eliminar = trim($_POST["id"]);
}
// Fin del if POST Eliminar -----------------------------------------------------------------------

// si aprieto el botón Delete ---------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
	// tomo el valor de id que se autocompletó en el formulario del Update
	$id = $_POST["id"];

	// Validar la entrada
	if (!empty($id)) {
		// Crear una declaración preparada para eliminar
		$stmt = $conexion->prepare("DELETE FROM usuarios WHERE id=?");
		$stmt->bind_param("i", $id);

		// Ejecutar la declaración preparada
		if ($stmt->execute()) {
			echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
					Registro eliminado con éxito.
					<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
					</div>";
		} else {
			echo "Error: " . $stmt->error;
		}

		// Cerrar la declaración preparada
		$stmt->close();
	} else {
		echo "Datos de entrada inválidos.";
	}
}
// Fin del if POST Delete -------------------------------------------------------------------------
?>


<!DOCTYPE html>
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
	<script src="https://kit.fontawesome.com/284989c7a4.js" crossorigin="anonymous"></script>
</head>

<body>
	<header>
		<!-- Aquí va la navbar -->
	</header>
	<main>
		<div class="container">
			<div class="row justify-content-center align-items-center g-2">
				<div class="col">
					<h1>CRUD PHP EXPLICADO</h1>
				</div>
			</div>
		</div>

<!-- Formulario para Crear -------------------------------------------------------------------- -->
		<div class="container my-2 shadow">
			<div class="row justify-content-center align-items-center g-2">
				<div class="col">
					<!-- Formulario para crear un usuario -->
					<h2>Crear Usuario</h2>
					<form action="crud.php" method="post" class="row g-3 mb-3">
						<!-- action es el archivo php al que le envío los datos, method puede ser POST (oculto) o GET (se muestra en la URL) -->
						<div class="col">
							<label for="apellido" class="form-label">Apellido:</label>
							<input type="text" name="apellido" id="apellido" class="form-control" required>
							<!-- el for del label debe ser igual al id del input -->
							<!-- name="value" es lo que enviamos por POST al php, el value de los inputs es lo que completa el usuario -->
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
						<!-- el código php de más arriba chequea si isset "create" -->
					</form>
				</div>
			</div>
		</div>
<!-- FIN Formulario para Crear ---------------------------------------------------------------- -->

<!-- Formulario para Mostrar ------------------------------------------------------------------ -->
<div class="container my-2 shadow">
			<div class="row justify-content-center align-items-center g-2">
				<div class="col">
					<!-- Formulario para leer usuarios -->
					<h2>Leer Usuarios</h2>

					<!-- Tabla para mostrar la información de los usuarios -->
					<div class="table-responsive">
						<table class="table table-light">
							<thead>
								<tr>
									<th scope="col">id</th>
									<th scope="col">Apellido</th>
									<th scope="col">Nombre</th>
									<th scope="col">Email</th>
									<th scope="col">Acción</th>
								</tr>
							</thead>
							<tbody>
								<!-- el contenido de la Tabla se genera con php, en un bucle while, lo mismo hacemos con el contenido de una Card -->
								<?php
								// Leer (Seleccionar) usuarios de la base de datos
								$consulta = "SELECT * FROM usuarios";
								$resultado = $conexion->query($consulta);

								// Verificar si hay resultados
								if ($resultado->num_rows > 0) {
									// Iterar sobre los resultados y mostrar cada usuario en una fila de la tabla
									while ($fila = $resultado->fetch_assoc()) {
										echo "<tr class=''>";
											echo "<td>" . $fila["id"] . "</td>"; // generalmente no mostramos públicamente el id
											echo "<td>" . $fila["apellido"] . "</td>";
											echo "<td>" . $fila["nombre"] . "</td>";
											echo "<td>" . $fila["email"] . "</td>";
											echo "<td>";
											// Formulario para acciones (Actualizar y Eliminar) en cada fila
											// tiene un input oculto (hidden) en el que pasamos el id al crud
												echo "<form action='crud.php' method='post'>";
													echo "<input type='submit' name='actualizar' value='Actualizar'>";
													echo "<input type='submit' name='eliminar' value='Eliminar' class='mx-3'>";
													echo "<input type='hidden' name='id' value='" . $fila["id"] . "'>";
												echo "</form>";
											echo "</td>";
										echo "</tr>";
									}
								} else {
									// Mensaje si no se encontraron registros
									echo "No se encontraron registros.";
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
<!-- FIN Formulario para Mostrar -------------------------------------------------------------- -->

<!-- Formulario para Actualizar ------------------------------------------------------------------ -->
<div class="container mb-2 shadow">
			<div class="row justify-content-center align-items-center g-2">
				<div class="col">
					<!-- Formulario para actualizar un usuario -->
					<h2>Actualizar Usuario</h2>
					<form action="crud.php" method="post" class="row g-3 mb-3">
						<div class="col">
							<label for="id_update" class="form-label">ID de Usuario:</label>
							<input type="text" name="id" id="id_update" class="form-control" value="<?php echo $id; ?>" required readonly>
								<!-- recibimos el $id del if isset "actualizar" y enviamos el name="id" al if isset "update"   -->
						</div>
						<div class="col">
							<label for="nuevo_apellido" class="form-label">Nuevo Apellido:</label>
							<input type="text" name="nuevo_apellido" id="nuevo_apellido" class="form-control" value="<?php echo $nuevo_apellido; ?>" required>
						</div>
						<div class="col">
							<label for="nuevo_nombre" class="form-label">Nuevo Nombre:</label>
							<input type="text" name="nuevo_nombre" id="nuevo_nombre" class="form-control" value="<?php echo $nuevo_nombre; ?>" required>
						</div>
						<div class="col">
							<label for="nuevo_email" class="form-label">Nuevo Email:</label>
							<input type="text" name="nuevo_email" id="nuevo_email" class="form-control" value="<?php echo $nuevo_email; ?>" required>
						</div>
						<input type="submit" name="update" value="Update">
						<!-- al apretar este botón entraremos al if isset "update" -->
					</form>
				</div>
			</div>
		</div>
<!-- FIN Formulario para Actualizar ----------------------------------------------------------- -->

<!-- Formulario para Eliminar ----------------------------------------------------------------- -->
		<div class="container my-2 shadow">
			<div class="row justify-content-center align-items-center g-2">
				<div class="col">
					<!-- Formulario para eliminar un usuario -->
					<h2>Eliminar Usuario</h2>
					<form action="crud.php" method="post" class="row g-3 mb-3">
						<div class="col">
							<label for="id_delete" class="form-label">ID de Usuario:</label>
							<input type="number" name="id" id="id_delete" class="form-control" value="<?php echo $id_eliminar; ?>" required readonly>
						</div>
						<input type="submit" name="delete" value="Delete">
					</form>
				</div>
			</div>
		</div>
<!-- FIN Formulario para Eliminar ------------------------------------------------------------- -->

	</main>
	<footer>
		<!-- place footer here -->
	</footer>
	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>

<?php
// Cerrar la conexión a la base de datos
$conexion->close();
?>