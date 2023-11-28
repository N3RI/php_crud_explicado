<?php
// 1. Establecer una conexión a la base de datos
// $conexion = mysqli_connect("localhost", "usuario", "contraseña", "base_de_datos");
$conexion = mysqli_connect("localhost", "root", "", "base_de_datos");

// 2. Comprobar la conexión y devolver error
if (mysqli_connect_errno()) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}

// 3. Seleccionar todos los registros de la tabla 'usuarios'
$consulta = "SELECT * FROM usuarios";
$resultado = mysqli_query($conexion, $consulta);

// 4. Mostrar los datos
while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "ID: " . $fila['id'] . "<br>"; // usualmente no se muestran los id públicamente
    echo "Apellido: " . $fila['apellido'] . "<br>"; // los puntos sirven para concatenar "textos" y $variables 
    echo "Nombre: " . $fila['nombre'] . "<br>";
    echo "Email: " . $fila['email'] . "<br>";
    echo "<hr>"; 
}
// mysqli_fetch_assoc() nos devuelve 1 row (una fila) de la consulta en cada vuelta del while
// $fila['id'] es un array que contiene 3 valores, apellido, nombre, email  

// 6. Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
