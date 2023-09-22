<?php
// Al utilizar un bloque try...catch, puedes capturar cualquier excepción que se arroje durante 
// la creación de la conexión y manejarla de manera adecuada, proporcionando un mensaje de error significativo. 
// Esto hace que tu código sea más robusto y proporciona información útil en caso de que se produzca un problema 
// con la conexión a la base de datos.

// Parámetros de conexión a la base de datos
$host = "localhost"; 
$usuario = "root"; // $usuario = "usuario";
$contraseña = ""; // $contraseña = "contraseña";
$base_de_datos = "base_de_datos";

try {
  // Crear la conexión a la base de datos
  $conexion = new mysqli($db_host, $db_user, $db_password, $db_name);

  // Comprobar la conexión
  if ($conexion->connect_error) {
    throw new Exception("La conexión a la base de datos falló: " . $conexion->connect_error);
  }
} catch (Exception $e) {
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}

// Configurar el conjunto de caracteres y la zona horaria
$conexion->set_charset("utf8mb4");
$conexion->query("SET time_zone = 'America/Argentina/Buenos_Aires'");
$conexion->query("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_general_ci'");

?>