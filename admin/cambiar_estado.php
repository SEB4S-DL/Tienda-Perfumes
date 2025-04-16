<?php
require '../db/db.php';

$id = $_GET['id'] ?? null;
if (!$id) exit("ID no válido");

$query = "SELECT estado FROM pedidos WHERE id = $id";
$result = mysqli_query($conn, $query);
$pedido = mysqli_fetch_assoc($result);

$estado_actual = $pedido['estado'] ?? null;
$estados = ['pendiente', 'en proceso', 'enviado', 'entregado'];
$indice = array_search($estado_actual, $estados);
$siguiente = $estados[min($indice + 1, count($estados) - 1)];

$update = "UPDATE pedidos SET estado = '$siguiente' WHERE id = $id";
mysqli_query($conn, $update);

header('Location: ../admin/admin_pedidos.php');
