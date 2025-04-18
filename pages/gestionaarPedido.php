<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar Pedido</title>
  <link rel="stylesheet" href="../assets/css/gestionarPedido.css">
  <link rel="stylesheet" href="../assets/css/styleheader.css">
  <link rel="stylesheet" href="../assets/css/stylePaginaInicio.css">
</head>
<body>
  <?php include '../includes/header.php'; ?>
  <?php require '../backend/mis_pedidos.php'?>
  <main>
    <h2>GESTIONAR PEDIDOS</h2>
    <table id="tablaPedidos">
      <thead>
        <tr>
          <th>N° id</th>
          <th>Precio</th>
          <th>Fecha</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        <!-- Aquí se cargarán los pedidos -->
      </tbody>
    </table>
  </main>

</body>
</html>
