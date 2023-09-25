<?php
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