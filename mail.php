<?php 
$para = "neritisocco@gmail.com";
$asunto = "Ejemplo de correo HTML";
$mensaje = "<html><body>";
$mensaje .= "<h1>Este es un ejemplo de correo HTML</h1>";
$mensaje .= "<p>¡Hola!</p>";
$mensaje .= "<p>Este es un correo con <strong>texto enriquecido</strong>.</p>";
$mensaje .= "</body></html>";

$cabeceras = "MIME-Version: 1.0" . "\r\n";
$cabeceras .= "Content-type: text/html; charset=UTF-8" . "\r\n";

// Envía el correo
mail($para, $asunto, $mensaje, $cabeceras);


/* ENVIO DE MAIL DESDE UNA BASE DE DATOS DE USUARIOS */

// Conexión a la base de datos (reemplaza con tus propios datos)
$servername = "servidor";
$username = "usuario";
$password = "contraseña";
$dbname = "base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener la lista de destinatarios
$sql = "SELECT email FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Configurar el correo electrónico
    $asunto = 'Asunto del correo';
    $mensaje = 'Cuerpo del correo HTML';

    // Cabeceras MIME
    $cabeceras = "MIME-Version: 1.0" . "\r\n";
    $cabeceras .= "Content-type: text/html; charset=UTF-8" . "\r\n";

    // Loop para enviar correos a cada destinatario
    while ($row = $result->fetch_assoc()) {
        $correo_destinatario = $row['email'];
        mail($correo_destinatario, $asunto, $mensaje, $cabeceras);
    }

    echo 'Los correos electrónicos se enviaron correctamente.';
} else {
    echo "No se encontraron destinatarios en la base de datos.";
}

// Cerrar la conexión a la base de datos
$conn->close();



?>