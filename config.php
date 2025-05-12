<?php
// Configuración de la base de datos
define('DB_HOST', 'mongo'); // Nombre del servicio MongoDB definido en docker-compose.yml
define('DB_PORT', 27017);   // Puerto predeterminado de MongoDB
define('DB_NAME', 'a_zoo'); // Nombre de la base de datos
define('DB_USER', '');      // Usuario (si aplica, deja vacío si no usas autenticación)
define('DB_PASSWORD', '');  // Contraseña (si aplica, deja vacío si no usas autenticación)

// Configuración adicional (si es necesario)
// define('APP_ENV', 'development'); // Ejemplo de variable de entorno

?>