<?php
$conexion = new mysqli("db", "root", "", "a_zoo");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa a MySQL desde Docker";
}
?>
