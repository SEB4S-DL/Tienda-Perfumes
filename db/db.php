<?php
$host = 'localhost';      // o la IP de tu servidor
$usuario = 'root';
$contrasena = '';
$basededatos = 'tienda_sena';

// Crear conexión
$conexion = new mysqli($host, $usuario, $contrasena, $basededatos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa";
}
?>
