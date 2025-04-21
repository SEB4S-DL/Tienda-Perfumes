<?php
session_start();
require_once '../db/db.php'; // Ajusta ruta si es necesario

$resultados = [];
$busqueda = '';

if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
    $busqueda = trim($_GET['q']);

    $sql = "SELECT * FROM productos 
            WHERE nombre LIKE ? 
               OR descripcion LIKE ? 
               OR marca LIKE ?";
    
    $stmt = $conexion->prepare($sql);
    $param = "%$busqueda%";
    $stmt->bind_param('sss', $param, $param, $param);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($fila = $result->fetch_assoc()) {
        $resultados[] = $fila;
    }

    $stmt->close();
}
?>
<?php include_once '../includes/header.php'; ?>

<main class="contenedor">
    <h2>Resultados de búsqueda para: <?= htmlspecialchars($busqueda) ?></h2>

    <?php if (!empty($resultados)): ?>
        <div class="contenedor-productos">
            <?php foreach ($resultados as $producto): ?>
                <div class="producto">
                    <img src="/TIENDA-PERFUMES/uploads/<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                    <h3><?= htmlspecialchars($producto['nombre']) ?></h3>
                    <p><?= htmlspecialchars($producto['marca']) ?></p>
                    <?php if ($producto['oferta']): ?>
                        <p class="precio"><span class="precio-oferta">$<?= number_format($producto['precio'], 2) ?></span> $<?= number_format($producto['precio'] * (1 - $producto['oferta'] / 100), 2) ?></p>
                    <?php else: ?>
                        <p class="precio">$<?= number_format($producto['precio'], 2) ?></p>
                    <?php endif; ?>

                    <form action="/TIENDA-PERFUMES/backend/agregar_carrito.php" method="POST">
                        <input type="hidden" name="id_producto" value="<?= $producto['id'] ?>">
                        <button type="submit">Agregar al carrito</button>
                    </form>

                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                        <div class="admin-buttons">
                            <a href="/TIENDA-PERFUMES/pages/editarProducto.php?id=<?= $producto['id'] ?>">Editar</a>
                            <a href="/TIENDA-PERFUMES/backend/eliminarProducto.php?id=<?= $producto['id'] ?>" onclick="return confirm('¿Seguro que quieres eliminar este producto?')">Eliminar</a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No se encontraron productos que coincidan con tu búsqueda.</p>
    <?php endif; ?>
</main>

<?php include_once '../includes/footer.php'; ?>
