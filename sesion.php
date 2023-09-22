<?php
/* Las sesiones son una forma sencilla de almacenar datos para usuarios de manera individual usando un ID de sesión
único. Esto se puede usar para hacer persistente la información de estado entre peticiones de páginas. 
Los ID de sesiones normalmente son enviados al navegador mediante cookies de sesión, y el ID se usa para recuperar
 los datos de sesión existente. La ausencia de un ID o una cookie de sesión permite saber a PHP para crear una 
 nueva sesión y generar un nuevo ID de sesión.
 Las sesiones siguen un flujo de trabajo sencillo. Cuando una sesión se inicia, PHP recuperará una sesión 
 existente usando el ID pasado (normalmente desde una cookie de sesión) o, si no se pasa una sesión, se creará 
 una sesión nueva. PHP rellenará la variable superglobal $_SESSION con cualesquiera datos de la sesión iniciada. 
 Cuando PHP se cierra, automáticamente toma el contenido de la variable superglobal $_SESSION, la serializa, 
 y la envía para almacenarla usando el gestor de almacenamiento de sesiones. 
*/

session_start();
if (!isset($_SESSION['count'])) {
  $_SESSION['count'] = 0;
} else {
  $_SESSION['count']++;
}
?>

<p>
Hola visitante, ha visto esta página <?php echo $_SESSION['count']; ?> veces.
</p>

<?php
session_start();
unset($_SESSION['count']);
?>
