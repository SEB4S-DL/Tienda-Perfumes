<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuit de Parfum - Perfumería</title>
  <link rel="stylesheet" href="../assets/css/Sesionhombre.css">
  <link rel="stylesheet" href="../assets/css/styleheader.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* Estilo para el contenedor de cada tarjeta de producto */
    .product-card {
        display: flex;
        flex-direction: column;  /* Esto permite que los elementos se alineen en columna */
        height: 100%; /* Asegura que el contenedor ocupe todo el alto disponible */
        border: 1px solid #ddd; /* Borde para la tarjeta */
        border-radius: 10px; /* Bordes redondeados */
        padding: 15px; /* Espaciado dentro de la tarjeta */
        background-color: #fff; /* Fondo blanco */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra sutil */
    }

    /* Esto asegura que la información del producto ocupe el espacio necesario sin alterar la posición de los botones */
    .product-info {
        flex-grow: 1; /* Permite que este contenedor crezca para llenar el espacio disponible */
    }

    /* Botones siempre al final de la tarjeta */
    .botones {
        margin-top: auto; /* Empuja los botones hacia el final del contenedor */
        display: flex;
        flex-direction: column;
        gap: 10px; /* Espacio entre los botones */
    }

    /* Estilos generales para los botones */
    .btn {
        background-color: #4b3c2f; /* Color café */
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #3c2a1e; /* Cambio de color al pasar el ratón */
    }

    .grande {
        padding: 12px 20px; /* Botón más grande para añadir al carrito */
    }

    /* Estilo para el formulario de cantidad */
    input[type="number"] {
        width: 60px;
        padding: 6px 8px;
        border-radius: 10px;
        border: 1px solid #ccc;
    }
  </style>
</head>
<body>

<?php 
  include '../includes/header.php'; 
  require '../db/db.php';

  // Obtener categoría desde GET o usar la predeterminada
  $categoria_id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 1;

  // Obtener nombre de la categoría
  $sql_categoria = "SELECT nombre FROM categorias WHERE id = $categoria_id LIMIT 1";
  $result_categoria = mysqli_query($conexion, $sql_categoria);

  if ($result_categoria && mysqli_num_rows($result_categoria) > 0) {
      $cat = mysqli_fetch_assoc($result_categoria);
      $titulo_categoria = $cat['nombre'];
  } else {
      $titulo_categoria = "Categoría no encontrada";
  }

  // Obtener productos activos
  $sql_productos = "SELECT * FROM productos WHERE categoria_id = $categoria_id AND activo = 1";
  $productos = mysqli_query($conexion, $sql_productos);
?>

<div class="" style="background-image: url('<?= $_img ?>');">
  <div class="content" style="background-color: #4b3c2f; color: white; justify-content:center; align-items: center">
    <h2 style="margin-left: 20px;"><?= htmlspecialchars($titulo_categoria) ?></h2>
  </div>
</div>

<div class="products-grid">
  <?php 
  if ($productos && $productos->num_rows > 0) {
      while ($p = mysqli_fetch_assoc($productos)): ?>
        <div class="product-card">
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
                <form class="form-carrito" method="post">
                <input type="hidden" name="producto_id" value="<?= $p['id'] ?>">
                <input type="number" name="cantidad" value="1" min="1" style="width: 60px; padding: 6px 8px; border-radius: 10px; border: 1px solid #ccc;">
                <br><br>
                <button type="submit" name="agregar" class="btn grande" data-id="<?= $p['id'] ?>">
                  Añadir al carrito <i class="fas fa-shopping-cart carrito"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
  <?php 
      endwhile;
  } else {
      echo "<h3>No se encontraron productos activos en esta categoría.</h3>";
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
