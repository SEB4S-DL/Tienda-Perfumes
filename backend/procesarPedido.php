<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Aseguramos que la sesión esté iniciada correctamente
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    header("Location: ../pages/detallePedido.php");
    exit();
}

require '../db/db.php';

$usuario_id = $_SESSION['usuario']['id'];

// Validar datos del formulario
if (
    !isset($_POST['provincia']) ||
    !isset($_POST['localidad']) ||
    !isset($_POST['direccion']) ||
    !isset($_POST['coste']) ||
    !isset($_SESSION['carrito']) || count($_SESSION['carrito']) === 0
) {
    echo "Faltan datos del formulario o el carrito está vacío.";
    exit();
}

// Escapar y procesar datos de manera segura
$provincia = mysqli_real_escape_string($conexion, $_POST['provincia']);
$localidad = mysqli_real_escape_string($conexion, $_POST['localidad']);
$direccion = mysqli_real_escape_string($conexion, $_POST['direccion']);
$coste = floatval(str_replace(',', '.', $_POST['coste']));
$estado = 'pendiente';

// Insertar el pedido en la base de datos
$sql = "INSERT INTO pedidos (usuario_id, provincia, localidad, direccion, coste, estado, fecha, hora)
        VALUES ('$usuario_id', '$provincia', '$localidad', '$direccion', '$coste', '$estado', CURDATE(), CURTIME())";

if (mysqli_query($conexion, $sql)) {
    $pedido_id = mysqli_insert_id($conexion);

    // Insertar cada producto del carrito como línea de pedido
    foreach ($_SESSION['carrito'] as $item) {
        $producto_id = $item['id'];
        $unidades = $item['cantidad'];

        $precio = (isset($item['precio_oferta']) && $item['precio_oferta'] > 0) ? $item['precio_oferta'] : $item['precio'];


        // Insertar la línea de pedido en la base de datos
        $sql_linea = "INSERT INTO lineas_pedidos (pedido_id, producto_id, unidades, precio)
                      VALUES ('$pedido_id', '$producto_id', '$unidades', '$precio')";
        
        // Ejecutar la consulta de la línea de pedido
        mysqli_query($conexion, $sql_linea);
    }

    // Vaciar el carrito después de procesar el pedido
    unset($_SESSION['carrito']);

    // Redirigir al detalle del pedido
    header("Location: ../pages/detallePedido.php?id=$pedido_id");
    exit();
} else {
    echo "Error al registrar el pedido: " . mysqli_error($conexion);
    exit();
}
?>
