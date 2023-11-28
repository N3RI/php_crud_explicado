<?php 
// ES NECESARIO INSTALAR PHPMailer https://github.com/PHPMailer/PHPMailer

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
    require 'path/to/PHPMailer/src/PHPMailer.php';
    require 'path/to/PHPMailer/src/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);

    try {
        $mail->isHTML(true);
        $mail->Subject = 'Asunto del correo';
        $mail->Body    = 'Cuerpo del correo HTML';

        // Loop para enviar correos a cada destinatario
        while ($row = $result->fetch_assoc()) {
            $correo_destinatario = $row['correo_electronico'];
            $mail->addAddress($correo_destinatario);
            $mail->send();
            $mail->clearAddresses();
        }

        echo 'Los correos electrónicos se enviaron correctamente.';
    } catch (Exception $e) {
        echo 'Hubo un error al enviar los correos: ' . $mail->ErrorInfo;
    }
} else {
    echo "No se encontraron destinatarios en la base de datos.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>