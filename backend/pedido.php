<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
require '../db/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['usuario']['id'];
    $direccion = $_POST['direccion'];
    $pago = $_POST['pago'];
    $fecha = date('Y-m-d');

    mysqli_query($conn, "INSERT INTO pedidos (usuario_id, direccion, metodo_pago, fecha, estado) 
        VALUES ('$usuario_id', '$direccion', '$pago', '$fecha', 'pendiente')");
    
    $pedido_id = mysqli_insert_id($conn);

    foreach ($_SESSION['carrito'] as $producto_id => $cantidad) {
        mysqli_query($conn, "INSERT INTO pedido_productos (pedido_id, producto_id, cantidad) 
            VALUES ('$pedido_id', '$producto_id', '$cantidad')");
    }

    unset($_SESSION['carrito']);
    echo "Pedido realizado con éxito.";
}
?>

<form method="POST">
    <input type="text" name="direccion" placeholder="Dirección de envío" required>
    <select name="pago">
        <option value="entrega">Pago contra entrega</option>
    </select>
    <input type="submit" value="Confirmar Pedido">
</form>
