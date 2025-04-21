<?php
// Activar errores temporalmente para debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) session_start();
require '../db/db.php';

// Detectar si es una petición AJAX
$is_ajax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

try {
    if (isset($_POST['producto_id'])) {
        $producto_id = intval($_POST['producto_id']);
        $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 1;
        if ($cantidad < 1) $cantidad = 1;

        $query = "SELECT * FROM productos WHERE id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("i", $producto_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $producto = $resultado->fetch_assoc();

        if (!$producto) {
            if ($is_ajax) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'Producto no encontrado']);
                exit;
            } else {
                header('Location: ../pages/carrito.php?error=producto_no_encontrado');
                exit;
            }
        }

        $precio = (!empty($producto['precio_oferta']) && $producto['precio_oferta'] > 0)
            ? $producto['precio_oferta']
            : $producto['precio'];

        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        if (isset($_SESSION['carrito'][$producto_id])) {
            $_SESSION['carrito'][$producto_id]['cantidad'] += $cantidad;
        } else {
            $_SESSION['carrito'][$producto_id] = [
                'id' => $producto['id'],
                'nombre' => $producto['nombre'],
                'precio' => $precio,
                'cantidad' => $cantidad,
                'imagen' => $producto['imagen'],
            ];
        }

        if ($is_ajax) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }

        header('Location: ../pages/carrito.php');
        exit;
    } else {
        if ($is_ajax) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'ID del producto no recibido']);
            exit;
        }
    }

} catch (Throwable $e) {
    if ($is_ajax) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'error' => 'Excepción: ' . $e->getMessage()
        ]);
        exit;
    } else {
        echo 'Error: ' . $e->getMessage();
        exit;
    }
}
