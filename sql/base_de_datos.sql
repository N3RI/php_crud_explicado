--
-- Base de datos: `base_de_datos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
 	`apellido` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
	PRIMARY KEY (`id`),
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Este código SQL crea una tabla llamada 'usuarios' en una base de datos.
-- La tabla tiene las siguientes columnas:
-- 1. 'id': un número entero de 11 dígitos que se incrementa automáticamente cada vez que se inserta un nuevo registro.
--    La clave primaria se utiliza para identificar de manera única cada fila en la tabla.
-- 2. 'apellido': una cadena de texto de hasta 50 caracteres que no puede ser nula.
-- 3. 'nombre': una cadena de texto de hasta 50 caracteres que no puede ser nula.
-- 4. 'email': una cadena de texto de hasta 50 caracteres que no puede ser nula.
--    Estas tres columnas se utilizan para almacenar información sobre los usuarios, como su nombre, apellido y dirección de correo electrónico.
-- 5. La columna 'id' se utiliza como clave primaria, lo que significa que cada 'id' debe ser único y no nulo.
-- El motor de almacenamiento utilizado es InnoDB, que es un motor de almacenamiento de tipo transaccional que proporciona integridad referencial.
-- El juego de caracteres utilizado es utf8mb4, que es adecuado para almacenar caracteres Unicode, incluidos aquellos que ocupan más de un byte.

