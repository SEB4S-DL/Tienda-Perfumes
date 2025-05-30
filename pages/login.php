<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-image">
                <img src="../assets/img/pexels-didsss-1190829.jpg" alt="Perfume bottle" class="perfume-image">
            </div>
            <div class="form-content">
                <h2 class="form-title">INICIAR SESIÓN</h2>
                <form id="loginForm" method="post" action="/TIENDA-PERFUMES/backend/login.php">
                    <div class="input-group">
                        <span class="material-symbols-outlined">mail</span>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group">
                        <span class="material-symbols-outlined">lock</span>
                        <input type="password" name="password" placeholder="Contraseña" required>
                    </div>
                    <button type="submit" class="submit-btn">INGRESAR</button>
                    <br>
                    <br>
                    <br>
                    <a href="/TIENDA-PERFUMES/pages/registro.php" style="text-decoration: none; color:aliceblue; margin-top: 10px; margin-left: 350px" class="submit-btn">Registrarse</a>
            </div>
        </div>
    </div>

</body>
</html>