<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuit de Parfum - Perfumería</title>
  <link rel="stylesheet" href="../assets/css/styleheader.css">
  <link rel="stylesheet" href="../assets/css/Sesionunisex.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    @import url("https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Poppins", sans-serif;
      background-color: #e9e9e9;
      color: #333;
    }

    .banner {
      background-image: url('https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Captura%20de%20pantalla%202025-04-13%20130402-SPptdDKPvaNzE1U1xLUzF0K3hSRr6F.png');
      background-size: cover;
      background-position: center;
      position: relative;
      height: 200px;
      display: flex;
      align-items: center;
      padding: 0 40px;
    }

    .banner::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .banner-content {
      position: relative;
      z-index: 1;
    }

    .banner-content h2 {
      font-family: "roboto";
      color: #fdfdfd;
      font-size: 36px;
      font-weight: 700;
      line-height: 1.2;
    }

    .products-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr); /* 3 columnas por fila */
      gap: 20px;
      padding: 30px;
      background-color: #e9e9e9;
    }

    .product-card {
      background-color: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .product-image {
      position: relative;
      height: 180px;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f9f9f9;
    }

    .product-image img {
      max-height: 90%;
      max-width: 90%;
      object-fit: contain;
    }

    .offer-tag {
      position: absolute;
      bottom: 15px;
      left: 80px;
      background-color: rgb(24, 23, 23);
      color: white;
      padding: 2px 8px;
      border-radius: 1px;
      font-size: 12px;
      font-weight: bold;
      font-family: sans-serif;
    }

    .product-info {
      padding: 15px;
    }

    .product-info h3 {
      font-size: 14px;
      margin-bottom: 10px;
      font-weight: 500;
    }

    .price {
      display: flex;
      flex-direction: column;
      margin-bottom: 10px;
    }

    .original-price {
      text-decoration: line-through;
      color: #999;
      font-size: 12px;
    }

    .sale-price {
      font-weight: 600;
      color: #333;
      font-size: 14px;
    }

    .botones {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .btn {
      background-color: #78624f;
      color: rgb(16, 16, 16);
      border: none;
      padding: 8px 12px;
      border-radius: 20px;
      cursor: pointer;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 5px;
      justify-content: center;
    }

    .btn:hover {
      background-color: #5e4e3f;
    }

    .grande {
      padding: 8px 20px;
    }

    .carrito {
      color: black;
    }

    @media (max-width: 1024px) {
      .products-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 600px) {
      .products-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <?php include '../includes/header.php'; ?>
    <?php require '../backend/podructo.php'; ?>
    <div class="banner">
      <div class="banner-content">
        <h2>Perfumes<br>Unisex</h2>
      </div>
    </div>

    <div class="products-grid">
      <?php while ($p = mysqli_fetch_assoc($productos)): ?>
        <div class="product-card">
          <div class="product-image">
            <?php if ($p['oferta'] == 1): ?>
              <span class="offer-tag">OFERTA</span>
            <?php endif; ?>
            <img src="../assets/img/chanelNo5.png?= $p['imagen'] ?>" alt="<?= $p['nombre'] ?>">
          </div>
          <div class="product-info">
            <h3><?= $p['nombre'] ?></h3>
            <div class="price">
              <?php if ($p['oferta'] == 1): ?>
                <span class="original-price">$<?= number_format($p['precio'], 0, ',', '.') ?></span>
              <?php endif; ?>
              <span class="sale-price">
                $<?= number_format($p['precio'] - ($p['precio'] * 0.3), 0, ',', '.') ?>
              </span>
            </div>
            <div class="botones">
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
              <button class="btn">Eliminar</button>
              <button class="btn">Editar</button>
            <?php endif; ?>

              <form action="../backend/carrito.php" method="post">
                <input type="hidden" name="producto_id" value="<?= $p['id'] ?>">
                <button type="submit" name="agregar" class="btn grande">
                  Comprar Ahora
                  <i class="fas fa-shopping-cart carrito"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

</body>
</html>
