<?php
// Verificar si la sesión ya está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../db/db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    header("Location: ../pages/gestionaarPedido.php");
    exit();
}

// Obtener el ID del usuario desde la sesión
$usuario_id = $_SESSION['usuario']['id'];

// Consultar los pedidos del usuario
$sql = "SELECT * FROM pedidos WHERE usuario_id = '$usuario_id'";
$resultado = mysqli_query($conexion, $sql);

// Verificar si la consulta fue exitosa
if (!$resultado) {
    echo "Error al obtener los pedidos: " . mysqli_error($conexion);
    exit();
}
?>

<!-- Código HTML para mostrar la tabla -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Variables necesarias para manipular la tabla
        const tbody = document.querySelector("#tablaPedidos tbody");
        
        <?php while ($pedido = mysqli_fetch_assoc($resultado)): ?>
        // Crear una nueva fila en la tabla por cada pedido
        const row = document.createElement('tr');
        
        // Crear las celdas para cada dato del pedido
        const idCell = document.createElement('td');
        idCell.textContent = "<?= $pedido['id'] ?>";
        row.appendChild(idCell);

        const precioCell = document.createElement('td');
        precioCell.textContent = "$<?= number_format($pedido['coste'], 0) ?>";
        row.appendChild(precioCell);

        const fechaCell = document.createElement('td');
        fechaCell.textContent = "<?= $pedido['fecha'] ?>";
        row.appendChild(fechaCell);

        const estadoCell = document.createElement('td');
        estadoCell.textContent = "<?= $pedido['estado'] ?>";
        row.appendChild(estadoCell);
        
        // Agregar la fila a la tabla
        tbody.appendChild(row);
        <?php endwhile; ?>
    });
</script>
