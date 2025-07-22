<?php
include 'conexion.php';

if (session_status() == PHP_SESSION_NONE) { //inicia sesion
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conexion->real_escape_string($_POST['email']); //recepta datos a travez de post
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password']; // Confirmacion de contraseña
    $tipo = 'usuario';

    // se valida la confirmación de contraseña
    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Las contraseñas no coinciden. Por favor, inténtalo de nuevo.';
        echo "<script>
            alert('Las contraseñas no coinciden. Por favor, inténtalo de nuevo.');
            window.location.href = 'register.php';
        </script>";
        exit();
    }

    // preparar e insertar la consulta con la contraseña en texto plano
    $stmt = $conexion->prepare("INSERT INTO usuarios (email, password, tipo) VALUES (?, ?, ?)");
    // aqui usamos $password directamente
    $stmt->bind_param("sss", $email, $password, $tipo);
    
    if ($stmt->execute()) { //aqui se crea variables de inicio de sesion
        $_SESSION["usuario"] = $email;
        $_SESSION["tipo"] = $tipo;
        $_SESSION["usuario_id"] = $stmt->insert_id; //id auto incremental
        
        header("Location: Usuario/home.php"); // Redirige a la página de inicio del usuario
        exit();
    } else {
        echo "<script>alert('Error al registrar: " . $conexion->error . "');</script>";
    }
    $stmt->close(); // cerramos la preparacion de la base de datos
    $conexion->close(); // cerrar la base de datos
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - AutoGo</title>
    <link rel="stylesheet" href="../public/estilos.css">
</head>
<body>
    <div class="container-auth">
        <h1>AutoGo</h1>
        <h2>Crear Cuenta</h2>
        
        <?php
        // Mostrar errores si existen
        if (isset($_SESSION['error'])) {
            echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']); // Limpiar el error después de mostrarlo
        }
        ?>

        <form method="POST" action="register.php">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" required>
            
            <label for="password">Contraseña</label>
            <input type="password" name="password" required>

            <label for="confirm_password">Confirmar Contraseña</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            
            <button type="submit" class="button">Registrarse</button>
        </form>
        
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
        <p>Volver al inicio <a href="../index.php">Inicio</a></p>
    </div>
</body>
</html>