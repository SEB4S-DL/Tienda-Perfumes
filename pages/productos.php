<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuit de Parfum - Perfumería</title>
  <link rel="stylesheet" href="../assets/css/Sesionhombre.css">
  <link rel="stylesheet" href="../assets/css/styleheader.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>


<?php 
  include '../includes/header.php';
  require '../db/db.php';

  // Consulta para obtener todos los productos
  $sql_productos = "SELECT * FROM productos";
  $productos = mysqli_query($conexion, $sql_productos);
?>

<div class="banner"></div>
  
<div style="background-color: #756349;">
    <h2 style="color: white; margin-left: 750px">Todos los productos</h2>
  </div>
  <div class="products-grid">
  <?php 
  if ($productos && $productos->num_rows > 0) {
      while ($p = mysqli_fetch_assoc($productos)): ?>
        <div class="product-card" style="<?= $p['activo'] == 0 ? 'opacity: 0.5; position: relative;' : '' ?>">
          <?php if ($p['activo'] == 0): ?>
            <div style="position: absolute; top: 10px; left: 10px; background: red; color: white; padding: 5px 10px; font-weight: bold; border-radius: 5px;">
              DESACTIVADO
            </div>
          <?php endif; ?>
          <div class="product-image">
            <?php if ($p['precio_oferta'] > 0): ?>
              <span class="offer-tag">OFERTA</span>
            <?php endif; ?>
            <img src="../uploads/<?= htmlspecialchars($p['imagen']) ?>" alt="<?= htmlspecialchars($p['nombre']) ?>">
          </div>
          <div class="product-info">
            <h3><?= htmlspecialchars($p['nombre']) ?></h3>
            <h3><?= htmlspecialchars($p['descripcion']) ?></h3>
            <div class="price">
              <?php if ($p['precio_oferta'] > 0): ?>
                <span class="original-price">$<?= number_format($p['precio'], 0, ',', '.') ?></span>
                <span class="sale-price">$<?= number_format($p['precio_oferta'], 0, ',', '.') ?></span>
              <?php else: ?>
                <span class="sale-price">$<?= number_format($p['precio'], 0, ',', '.') ?></span>
              <?php endif; ?>
            </div>
            <?php if ($p['activo'] == 1): ?>
              <div class="botones">
                <?php if (isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] === 'admin'): ?>
                  <form action="../backend/eliminar_producto.php" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                    <input type="hidden" name="producto_id" value="<?= $p['id'] ?>">
                    <button type="submit" class="btn">Eliminar</button>
                  </form>

                  <form action="../pages/editar_productos.php" method="get">
                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                    <button type="submit" class="btn">Editar</button>
                  </form>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
  <?php 
      endwhile;
  } else {
      echo "<h3>No hay productos registrados todavía.</h3>";
  }
  ?>
</div>

<script>
  document.querySelectorAll('.form-carrito').forEach(form => {
    form.addEventListener('submit', async function (e) {
      e.preventDefault();

      const formData = new FormData(form);

      try {
        const response = await fetch('../backend/carrito.php', {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        });

        const data = await response.json();

        if (data.success) {
          alert('Producto agregado al carrito 🛒');
        } else {
          alert('Error: ' + (data.error || 'No se pudo agregar al carrito 🤔'));
        }
      } catch (error) {
        console.error('Error en el fetch:', error);
        alert('Ups, algo salió mal 😓');
      }
    });
  });
</script>

</body>
</html>
