<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Realizar Pedido - Nuit de Parfum</title>
  <link rel="stylesheet" href="../assets/css/realizarPedido.css" />
</head>
<body>
<?php session_start()?>

<?php include '../includes/header.php'; ?>


  <main class="contenedor">
    <h2>Realizar Pedido</h2>
    <form id="pedidoForm">
      <input type="text" placeholder="Dirección" required />
      <input type="text" placeholder="Ciudad" required />
      <input type="text" placeholder="Departamento" required />
      <input type="text" placeholder="Número de contacto" required />
      <button type="submit">Confirmar Pedido</button>
    </form>
  </main>


  <script src="js/realizarPedido.js"></script>
</body>
</html>
