<?php
$host = 'localhost';      // o la IP de tu servidor
$usuario = 'admin';
$contrasena = '123456';
$basededatos = 'tienda_sena';

// Crear conexión
$conexion = new mysqli($host, $usuario, $contrasena, $basededatos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    
}
?>
