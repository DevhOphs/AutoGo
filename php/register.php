<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - AutoGo</title>
    <link rel="stylesheet" href="../public/estilos.css">
</head>
<body>
    <div class="container-auth">
        <header>
            <h1>AutoGo</h1>
        </header>
        <main>
            <h3>Crear Cuenta</h3>
            <p>Renta tu auto ideal en minutos</p>
            <form method="POST" action="procesar_register.php" onsubmit="return validateRegister()">
                <label for="nombre">Nombre completo</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre completo">
                
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" placeholder="tu@correo.com">
                
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Crea una contraseña">
                
                <label for="confirm_password">Confirmar Contraseña</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirma tu contraseña">
                
                <button type="submit" class="button">Registrarse</button>
            </form>
            <p>O</p>
            <p><a href="login.php">¿Ya tienes cuenta? Iniciar sesión</a></p>
        </main>
    </div>
    <script src="../public/script.js"></script>
</body>
</html>