<?php
session_start();

// Incluir la conexión a la base de datos
require '../db/db.php';

if (isset($_POST['agregar'])) {
    // Obtener ID del producto
    $producto_id = $_POST['producto_id'];

    // Obtener la cantidad enviada por el formulario (por defecto 1 si no se envía)
    $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 1;
    if ($cantidad < 1) $cantidad = 1; // Evitar cantidades menores a 1

    // Consulta para obtener el producto por ID
    $query = "SELECT * FROM productos WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $producto = $resultado->fetch_assoc();

    // Verificar si el producto tiene un precio con oferta
    if (!empty($producto['precio_oferta']) && $producto['precio_oferta'] > 0) {
        $precio = $producto['precio_oferta'];
    } else {
        $precio = $producto['precio'];
    }

    // Verificar si el carrito ya está inicializado
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Verificar si el producto ya está en el carrito
    if (isset($_SESSION['carrito'][$producto_id])) {
        $_SESSION['carrito'][$producto_id]['cantidad'] += $cantidad; // Sumar cantidad seleccionada
    } else {
        // Agregar nuevo producto al carrito con la cantidad seleccionada
        $_SESSION['carrito'][$producto_id] = [
            'id' => $producto['id'],
            'nombre' => $producto['nombre'],
            'precio' => $precio,
            'cantidad' => $cantidad,
            'imagen' => $producto['imagen'],
        ];
    }

    // Redirigir al carrito para ver los cambios
    header('Location: ../pages/carrito.php');
    exit();
}
?>