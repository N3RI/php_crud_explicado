<?php
// $conexion = mysqli_connect("localhost", "usuario", "contraseña", "base_de_datos");
$conexion = mysqli_connect("localhost", "root", "", "base_de_datos");

if (mysqli_connect_errno()) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}

// Seleccionar todos los registros de la tabla 'usuarios'
$consulta = "SELECT * FROM usuarios";
$resultado = mysqli_query($conexion, $consulta);

// Mostrar los datos
while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "ID: " . $fila['id'] . "<br>"; // usualmente no se muestran los id públicamente
    echo "Apellido: " . $fila['apellido'] . "<br>";
    echo "Nombre: " . $fila['nombre'] . "<br>";
    echo "Email: " . $fila['email'] . "<br>";
    echo "<hr>";
}

mysqli_close($conexion);
?>
