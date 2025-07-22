<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    
    echo "Intentando iniciar sesión con email: $email y contraseña: $password";
    echo "<script>setTimeout(function(){ window.location.href = 'home.php'; }, 2500);</script>";
}
?>