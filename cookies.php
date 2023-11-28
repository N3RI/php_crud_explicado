<?php
/* En PHP, las cookies son una forma común de almacenar pequeñas cantidades de información en el navegador del usuario 
para su posterior uso. Aquí tienes un ejemplo simple de cómo usar cookies en PHP.
*/

// Define el nombre de usuario que deseas almacenar en la cookie
$nombreUsuario = "Neri Tisocco";

// Establece la cookie con el nombre 'usuario' y el valor del nombre de usuario
setcookie("usuario", $nombreUsuario, time() + 3600, "/");

/* setcookie("usuario", $nombreUsuario, time() + 3600, "/") establece una cookie llamada "usuario" con el valor de $nombreUsuario.
time() + 3600 indica que la cookie expirará después de 3600 segundos (1 hora).
"/" especifica que la cookie estará disponible en todo el sitio.
*/
?>

<?php
// Verifica si la cookie 'usuario' está establecida
if (isset($_COOKIE["usuario"])) {
    // Recupera el valor de la cookie 'usuario'
    $nombreUsuario = $_COOKIE["usuario"];
    echo "¡Hola, $nombreUsuario!";
} else {
    echo "Bienvenido invitado";
}
?>
