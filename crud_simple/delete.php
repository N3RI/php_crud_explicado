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

// 4. Eliminar un registro de la tabla 'usuarios'
$consulta = "DELETE FROM usuarios WHERE id=$id";
$resultado = mysqli_query($conexion, $consulta);

// 5. Comprobar si se ha eliminado correctamente y mostrar mensaje de éxito o error
if ($resultado) {
    echo "Registro eliminado con éxito. ";
		echo "<a href='../'>Volver al inicio</a>";
} else {
    echo "Error: " . mysqli_error($conexion);
}

// 6. Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
