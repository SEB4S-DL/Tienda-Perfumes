<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    header("Location: ../pages/detallePedido.php");
    exit();
}

require '../db/db.php'; // Asegúrate de que este archivo tiene la conexión como $conexion

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

// Escapar datos
$provincia = mysqli_real_escape_string($conexion, $_POST['provincia']);
$localidad = mysqli_real_escape_string($conexion, $_POST['localidad']);
$direccion = mysqli_real_escape_string($conexion, $_POST['direccion']);
$coste = floatval(str_replace(',', '.', $_POST['coste']));
$estado = 'pendiente';

// Insertar el pedido
$sql = "INSERT INTO pedidos (usuario_id, provincia, localidad, direccion, coste, estado, fecha, hora)
        VALUES ('$usuario_id', '$provincia', '$localidad', '$direccion', '$coste', '$estado', CURDATE(), CURTIME())";

if (mysqli_query($conexion, $sql)) {
    $pedido_id = mysqli_insert_id($conexion);

    foreach ($_SESSION['carrito'] as $item) {
        $producto_id = $item['id'];
        $unidades = intval($item['cantidad']);
        $precio = (isset($item['precio_oferta']) && $item['precio_oferta'] > 0) ? $item['precio_oferta'] : $item['precio'];

        // Insertar línea de pedido
        $sql_linea = "INSERT INTO lineas_pedidos (pedido_id, producto_id, unidades, precio)
                      VALUES ('$pedido_id', '$producto_id', '$unidades', '$precio')";
        mysqli_query($conexion, $sql_linea);

        // Actualizar stock
        $sql_stock = "UPDATE productos SET stock = stock - $unidades WHERE id = $producto_id AND stock >= $unidades";
        mysqli_query($conexion, $sql_stock);

        // Validar si el stock se actualizó correctamente
        if (mysqli_affected_rows($conexion) === 0) {
            echo "Error: Stock insuficiente para el producto ID $producto_id";
            exit();
        }
    }

    // Vaciar el carrito
    unset($_SESSION['carrito']);

    // Redirigir al detalle del pedido
    header("Location: /TIENDA-PERFUMES/index.php");
    exit();

} else {
    echo "Error al registrar el pedido: " . mysqli_error($conexion);
    exit();
}
?>
