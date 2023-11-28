<?php
// 1. Establecer una conexión a la base de datos
// $conexion = mysqli_connect("localhost", "usuario", "contraseña", "base_de_datos");
$conexion = mysqli_connect("localhost", "root", "", "base_de_datos");

// 2. Comprobar la conexión y devolver error
if (mysqli_connect_errno()) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}

// 3. Declarar las $variables que usaremos
$id = 1;
$nuevoNombre = "Nuevo Nombre";

// 4. Actualizar un registro en la tabla 'usuarios'
$consulta = "UPDATE usuarios SET nombre='$nuevoNombre' WHERE id=$id";
$resultado = mysqli_query($conexion, $consulta);

// 5. Comprobar si se ha actualizado correctamente y mostrar mensaje de éxito o error
if ($resultado) {
    echo "Registro actualizado con éxito. ";
		echo "<a href='../'>Volver al inicio</a>";
} else {
    echo "Error: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
