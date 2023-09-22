<?php
// Establecer una conexión a la base de datos
// $conexion = mysqli_connect("localhost", "usuario", "contraseña", "base_de_datos");
$conexion = mysqli_connect("localhost", "root", "", "base_de_datos");

// Comprobar la conexión
if (mysqli_connect_errno()) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}

// Insertar datos en la tabla 'usuarios'
$apellido = "Tisocco";
$nombre = "Neri";
$email = "neri@tisocco.com";
$consulta = "INSERT INTO usuarios (apellido, nombre, email) VALUES ('$apellido', '$nombre', '$email')";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {
    echo "Registro creado con éxito";
} else {
    echo "Error: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
