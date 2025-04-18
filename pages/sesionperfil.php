<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuit de Parfum - Perfumería</title>

    <!-- Forzar recarga del CSS agregando marca de tiempo -->
    <link rel="stylesheet" href="../assets/css/perfilUsuario.css?v=<?= time() ?>">
    <link rel="stylesheet" href="../assets/css/styleheader.css?v=<?= time() ?>">
    <link rel="stylesheet" href="../assets/css/stylePaginaInicio.css?v=<?= time() ?>">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Raleway:wght@300;400;500&display=swap">
</head>
<body>

<div class="container">
    <?php include '../includes/header.php'; ?>

    <main>
        <div class="profile-container">
            <h2 class="profile-title">Datos de Perfil</h2>

            <div class="profile-content">
                <div class="profile-form">
                    <div class="form-group">
                        <input type="text" id="nombre" value="<?= htmlspecialchars($_SESSION['nombre'] ?? '') ?>" placeholder="Nombre" readonly>
                    </div>

                    <div class="form-group">
                        <input type="email" id="email" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>" placeholder="Email" readonly>
                    </div>
                </div>

                <div class="profile-image">
                    <img src="/TIENDA-PERFUMES/pages/mostrarimagen.php" alt="Foto" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover;">
                </div>
            </div>
        </div>
    </main>

    <br><br><br><br><br>
    <?php include '../includes/footer.php'; ?>
</div>

</body>
</html>
