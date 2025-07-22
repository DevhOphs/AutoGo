<?php
session_start();

// Verificación esencial de sesión
if (!isset($_SESSION["usuario"]) || $_SESSION["tipo"] !== "usuario") {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';
$error = '';
$success = '';
$data = [];
$total = 0; // Inicializamos la variable total

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger todos los datos del formulario
    $data = $_POST;
    
    // Calcular días y total (lo movemos antes del if para que esté disponible en ambos pasos)
    if (!empty($data['fecha_recogida']) && !empty($data['fecha_devolucion']) && !empty($data['price'])) {
        $date1 = new DateTime($data['fecha_recogida']);
        $date2 = new DateTime($data['fecha_devolucion']);
        $days = $date1->diff($date2)->days;
        $total = $days * floatval($data['price']);
    }
    
    // Si se enviaron datos de tarjeta (Paso 2)
    if (isset($_POST['card_number'])) {
        // Insertar reserva
        $stmt = $conexion->prepare("INSERT INTO reservas (
            usuario_id, vehiculo_id, fecha_recogida, fecha_devolucion,
            ubicacion_recogida, ubicacion_devolucion, metodo_pago, total, estado
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Confirmada')");
        
        $car_id = intval($data['car_id']);
        $stmt->bind_param("iisssssd", 
            $_SESSION['usuario_id'],
            $car_id,
            $data['fecha_recogida'],
            $data['fecha_devolucion'],
            $data['ubicacion_recogida'],
            $data['ubicacion_devolucion'],
            $data['pago'],
            $total
        );
        
        if ($stmt->execute()) {
            $success = '¡Reserva confirmada! Redirigiendo...';
            echo "<script>setTimeout(() => window.location.href = 'mis_reservas.php', 2000);</script>";
        } else {
            $error = 'Error al procesar la reserva';
        }
    }
} else {
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoGo - Pago</title>
    <link rel="stylesheet" href="/public/estilos.css">
</head>
<body>
    <div class="container-home">
        <div class="header">
            <div class="autogo-container">
                <img src="/assets/car-icon.png" alt="Icono AutoGo" width="75">
                <span class="autogo-text">AutoGo</span>
            </div>
            <div class="nav-links">
                <a href="home.php">Inicio</a>
                <a href="../../logout.php">Cerrar Sesión</a>
            </div>
        </div>

        <div class="pago-container">
            <?php if ($success): ?>
                <div class="success-message">
                    <h2>¡Listo!</h2>
                    <p><?= $success ?></p>
                </div>
            <?php else: ?>
                <h2>Pago</h2>
                <?php if ($error): ?>
                    <div class="error-message"><?= $error ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <!-- Campos ocultos con datos de reserva -->
                    <input type="hidden" name="car_id" value="<?= $data['car_id'] ?? '' ?>">
                    <input type="hidden" name="model" value="<?= $data['model'] ?? '' ?>">
                    <input type="hidden" name="price" value="<?= $data['price'] ?? '' ?>">
                    <input type="hidden" name="fecha_recogida" value="<?= $data['fecha_recogida'] ?? '' ?>">
                    <input type="hidden" name="fecha_devolucion" value="<?= $data['fecha_devolucion'] ?? '' ?>">
                    <input type="hidden" name="ubicacion_recogida" value="<?= $data['ubicacion_recogida'] ?? '' ?>">
                    <input type="hidden" name="ubicacion_devolucion" value="<?= $data['ubicacion_devolucion'] ?? '' ?>">
                    <input type="hidden" name="pago" value="<?= $data['pago'] ?? '' ?>">
                    <input type="hidden" name="total" value="<?= $total ?>"> <!-- Añadimos el total calculado -->
                    
                    <!-- Formulario de pago solo si no hay éxito -->
                    <?php if (!isset($data['card_number'])): ?>
                        <label>Número de tarjeta:</label>
                        <input type="text" name="card_number" placeholder="1234 5678 9012 3456" required>
                        
                        <label>Vencimiento (MM/AA):</label>
                        <input type="text" name="expiry_date" placeholder="MM/AA" required>
                        
                        <label>CVC:</label>
                        <input type="text" name="cvc" placeholder="123" required>
                        
                        <label>Nombre en tarjeta:</label>
                        <input type="text" name="card_holder" placeholder="Como aparece en la tarjeta" required>
                        
                        <div class="resumen">
                            <h3>Resumen de Reserva</h3>
                            <p><strong>Vehículo:</strong> <?= $data['model'] ?? '' ?></p>
                            <p><strong>Recogida:</strong> <?= $data['fecha_recogida'] ?? '' ?> (<?= $data['ubicacion_recogida'] ?? '' ?>)</p>
                            <p><strong>Devolución:</strong> <?= $data['fecha_devolucion'] ?? '' ?> (<?= $data['ubicacion_devolucion'] ?? '' ?>)</p>
                            <p><strong>Días:</strong> <?= $days ?? 0 ?></p>
                            <p><strong>Precio por día:</strong> $<?= number_format($data['price'] ?? 0, 2) ?></p>
                            <p><strong>Total:</strong> $<?= number_format($total, 2) ?></p>
                        </div>
                        
                        <button type="submit" class="button">Confirmar Pago</button>
                    <?php endif; ?>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>