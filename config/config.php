<?php
// Parámetros de conexión a la base de datos
$host = "localhost"; 
$usuario = "root"; // $usuario = "usuario";
$contraseña = ""; // $contraseña = "contraseña";
$base_de_datos = "base_de_datos";

// Crear una nueva conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);

// Comprobar la conexión
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

// Configurar el conjunto de caracteres y la zona horaria
$conexion->set_charset("utf8mb4");
$conexion->query("SET time_zone = 'America/Argentina/Buenos_Aires'");
$conexion->query("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_general_ci'");

?>