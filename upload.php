<?php
// Explicación: https://www.php.net/manual/es/features.file-upload.post-method.php 
$dir_subida = '/var/www/uploads/';
$archivo_subido = $dir_subida . basename($_FILES['archivo_usuario']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['archivo_usuario']['tmp_name'], $archivo_subido)) {
	echo "El archivo es válido y se subió con éxito.\n";
} else {
	echo "¡Posible ataque de subida de archivos!\n";
}

echo 'Más información de depuración:';
print_r($_FILES);

print "</pre>";

/*
$_FILES['archivo_usuario']['name']
El nombre original del archivo en la máquina del cliente.
$_FILES['archivo_usuario']['type']
El tipo MIME del archivo, si el navegador proporcionó esta información. Un ejemplo sería "image/gif". Este tipo MIME, sin embargo, no se comprueba en el lado de PHP y por lo tanto no se garantiza su valor.
$_FILES['archivo_usuario']['size']
El tamaño, en bytes, del archivo subido.
$_FILES['archivo_usuario']['tmp_name']
El nombre temporal del archivo en el cual se almacena el archivo subido en el servidor.
$_FILES['archivo_usuario']['error']
El código de error asociado a esta subida.
*/
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Subida de Archivos</title>
</head>

<body>
	<!-- El tipo de codificación de datos, enctype, DEBE especificarse como sigue -->
	<form enctype="multipart/form-data" action="upload.php" method="POST">
		<!-- MAX_FILE_SIZE debe preceder al campo de entrada del archivo -->
		<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
		<!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
		Enviar este archivo: <input name="archivo_usuario" type="file" />
		<input type="submit" value="Enviar archivo" />
	</form>
</body>

</html>
