<?php
// $conexion = mysqli_connect("localhost", "usuario", "contraseña", "base_de_datos");
$conexion = mysqli_connect("localhost", "root", "", "base_de_datos");

if (mysqli_connect_errno()) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}

// Actualizar un registro en la tabla 'usuarios'
$id = 1;
$nuevoNombre = "Nuevo Nombre";

$consulta = "UPDATE usuarios SET nombre='$nuevoNombre' WHERE id=$id";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {
    echo "Registro actualizado con éxito";
} else {
    echo "Error: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
