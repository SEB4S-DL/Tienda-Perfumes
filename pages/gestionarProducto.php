<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestionar Productos - Nuit de Parfum</title>
  <link rel="stylesheet" href="../assets/css/gestionarProducto.css" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
<?php session_start()?>

<?php include '../includes/header.php'; ?>


  <table>
    <thead>
      <tr>
        <th>N°</th>
        <th>id</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>2</td>
        <td>2</td>
        <td>Dolce & Gabbana<br>The One</td>
        <td>344,000 COP</td>
        <td>2</td>
        <td>
            <a href="editarProducto.html" class="btn editar">EDITAR</a>

          <button class="btn eliminar" onclick="abrirEliminar()">ELIMINAR</button>
        </td>
      </tr>
    </tbody>
  </table>

  <!-- Popup Editar -->
  <div class="popup-overlay" id="popupEditar">
    <div class="popup">
      <h3>Editar Producto</h3>
      <input type="text" placeholder="Nombre del producto" />
      <input type="text" placeholder="Precio" />
      <input type="number" placeholder="Stock" />
      <br />
      <button class="btn editar" onclick="cerrarEditar()">Guardar</button>
      <button class="btn eliminar" onclick="cerrarEditar()">Cancelar</button>
    </div>
  </div>

  <!-- Popup Eliminar -->
  <div class="popup-overlay" id="popupEliminar">
    <div class="popup">
      <h3>¿Eliminar producto?</h3>
      <p>Esta acción no se puede deshacer.</p>
      <button class="btn eliminar" onclick="cerrarEliminar()">Eliminar</button>
      <button class="btn editar" onclick="cerrarEliminar()">Cancelar</button>
    </div>
  </div>

  <script src="js/gestionarProducto.js"></script>
</body>
</html>
