<?php
/* Entorno de Producción: Este es el entorno en el que tu aplicación está en funcionamiento y 
es accesible para los usuarios finales. En el entorno de producción, tu aplicación debe ser estable, 
segura y eficiente. Los usuarios reales interactúan con la aplicación en este entorno, 
por lo que cualquier error o problema puede tener un impacto real en ellos. 
Las bases de datos en producción suelen contener datos reales y sensibles.
Entorno de Desarrollo: Este es el entorno donde los desarrolladores crean y prueban la aplicación 
antes de implementarla en producción. En el entorno de desarrollo, es común realizar cambios 
en el código, depurar, probar nuevas características y hacer ajustes sin afectar a los usuarios reales. 
Las bases de datos en desarrollo a menudo contienen datos de prueba o ficticios.
*/

// Definir una variable que indique el entorno actual (puedes establecer esto en tu configuración)
$entorno = "produccion"; // O podrías establecerlo en "desarrollo"

if ($entorno === "produccion") {
    // Configuración de la base de datos en entorno de producción
    $db_host = "produccion_host";
    $db_user = "produccion_usuario";
    $db_password = "produccion_contraseña";
    $db_name = "produccion_base_de_datos";
} elseif ($entorno === "desarrollo") {
    // Configuración de la base de datos en entorno de desarrollo
    $db_host = "desarrollo_host";
    $db_user = "desarrollo_usuario";
    $db_password = "desarrollo_contraseña";
    $db_name = "desarrollo_base_de_datos";
} else {
    die("Entorno no válido");
}

try {
    // Crear la conexión a la base de datos según la configuración del entorno
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
