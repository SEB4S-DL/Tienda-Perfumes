<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuit de Parfum - Perfumería</title>
    <link rel="stylesheet" href="../assets/css/perfilUsuario.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Raleway:wght@300;400;500&display=swap">
</head>
<body>
<?php session_start()?>

    <div class="container">
      
    <?php include '../includes/header.php'; ?>

        <!-- Main Content -->
        <main>
            <div class="profile-container">
                <h2 class="profile-title">Datos de Perfil</h2>
                
                <div class="profile-content">
                    <div class="profile-form">
                        <div class="form-group">
                            <input type="text" id="nombre" placeholder="Nombre Completo">
                        </div>
                        
                        <div class="form-group">
                            <input type="email" id="email" placeholder="Email">
                        </div>
                        
                        <div class="form-group">
                            <input type="text" id="direccion" placeholder="Direccion">
                        </div>
                    </div>
                    
                    <div class="profile-image">
                        <img src="../assets/img/imagenperfil.jpg" alt="Foto de Perfil">
                    </div>
                </div>
            </div>
        </main>
    <br>
    <br>
  <?php include '../includes/footer.php'; ?>
        
    </div>

    <script src="/Front/js/perfilUsuario.js"></script>
</body>
</html>