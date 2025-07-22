<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "AutoGo";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Establecer charset
$conexion->set_charset("utf8");
?>