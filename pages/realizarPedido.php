<?php 
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id'])) {
  header("Location: ../pages/login.php");
  exit();
}

$total = 0;
if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
    foreach ($_SESSION['carrito'] as $item) {
      $precio = floatval($item['precio']);
      $total += $precio * intval($item['cantidad']);
    }
} else {
    $_SESSION['error_carrito_vacio'] = "Tu carrito está vacío. Agrega productos antes de continuar.";
    header("Location: ../pages/carrito.php");
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];

// Redirección suave tras pedido exitoso
if (isset($_SESSION['pedido_exitoso'])) {
    header("refresh:2;url=../index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Realizar Pedido - Nuit de Parfum</title>
  <link rel="stylesheet" href="../assets/css/realizarPedido.css" />
  <link rel="stylesheet" href="../assets/css/styleheader.css">
  <link rel="stylesheet" href="../assets/css/stylefooter.css">
  
  <style>
    /* Estilo del modal */
    .modal {
      display: none; 
      position: fixed; 
      z-index: 1; 
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.4); 
      padding-top: 60px;
    }

    .modal-content {
      background-color: #fefefe;
      margin: 5% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      text-align: center;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  </style>

</head>
<body>
<?php include '../includes/header.php'; ?>
<main class="contenedor">
  <h2>Realizar Pedido</h2>

  <?php 
  if (isset($_SESSION['error_carrito_vacio'])) {
      echo '<p class="error-message">' . $_SESSION['error_carrito_vacio'] . '</p>';
      unset($_SESSION['error_carrito_vacio']);
  }

  if (isset($_SESSION['pedido_exitoso'])) {
      echo '<p class="success-message" style="color: green; font-weight: bold;">' . $_SESSION['pedido_exitoso'] . '</p>';
      unset($_SESSION['pedido_exitoso']);
  }
  ?>

  <form id="pedidoForm" action="../backend/procesarPedido.php" method="post" onsubmit="mostrarModal(); return false;">
    <input type="hidden" name="usuario_id" value="<?= $usuario_id ?>" />
    <input type="text" name="provincia" placeholder="Departamento" />
    <input type="text" name="localidad" placeholder="Ciudad" />
    <input type="text" name="direccion" placeholder="Dirección" />
    
    <label for="coste">Total:</label>
    <input type="text" name="coste" id="coste" value="<?= number_format($total, 2, '.', '') ?>" readonly />

    <button type="submit">Confirmar Pedido</button>
  </form>

  <!-- Modal de Confirmación -->
  <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="cerrarModal()">&times;</span>
      <h2>¡Compra exitosa!</h2>
      <p>Gracias por tu compra. Tu pedido ha sido procesado correctamente.</p>
      <button onclick="enviarFormulario()">Aceptar</button>
    </div>
  </div>
</main>

<script>
  function mostrarModal() {
    // Muestra el modal
    document.getElementById("modal").style.display = "block";
  }

  function cerrarModal() {
    // Cierra el modal
    document.getElementById("modal").style.display = "none";
  }

  function enviarFormulario() {
    // Envía el formulario y procesa el pedido
    document.getElementById("pedidoForm").submit();
  }
</script>

</body>
</html>
