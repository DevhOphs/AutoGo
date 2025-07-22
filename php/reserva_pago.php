<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = isset($_POST['car_id']) ? htmlspecialchars($_POST['car_id']) : '';
    $model = isset($_POST['model']) ? htmlspecialchars($_POST['model']) : 'No seleccionado';
    $year = isset($_POST['year']) ? htmlspecialchars($_POST['year']) : '';
    $transmission = isset($_POST['transmission']) ? htmlspecialchars($_POST['transmission']) : '';
    $fuel = isset($_POST['fuel']) ? htmlspecialchars($_POST['fuel']) : '';
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
    $fecha_recogida = isset($_POST['fecha_recogida']) ? htmlspecialchars($_POST['fecha_recogida']) : '';
    $ubicacion_recogida = isset($_POST['ubicacion_recogida']) ? htmlspecialchars($_POST['ubicacion_recogida']) : '';
    $fecha_devolucion = isset($_POST['fecha_devolucion']) ? htmlspecialchars($_POST['fecha_devolucion']) : '';
    $ubicacion_devolucion = isset($_POST['ubicacion_devolucion']) ? htmlspecialchars($_POST['ubicacion_devolucion']) : '';
    $pago = isset($_POST['pago']) ? htmlspecialchars($_POST['pago']) : '';

    // Calcular el número de días
    $date1 = new DateTime($fecha_recogida);
    $date2 = new DateTime($fecha_devolucion);
    $interval = $date1->diff($date2);
    $days = $interval->days;
    $total = $days * $price;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoGo - Pago</title>
    <link rel="stylesheet" href="../public/estilos.css">
</head>
<body>
    <div class="container-home">
        <div class="header">
            <div class="autogo-container">
                <img src="/assets/car-icon.png" alt="Icono de Auto" width="75">
                <span class="autogo-text">AutoGo</span>
            </div>
            <div class="nav-links">
                <a href="home.php">Inicio</a>
                <a href="../index.html">Cerrar Sesión</a>
            </div>
        </div>

        <div class="pago-container">
            <h2>Pago Seguro</h2>
            <p>Tu auto ideal, al máximo.</p>
            
            <form action="home.php" method="POST">
                <div class="tarjeta-section">
                    <div class="tarjeta-header">
                        <h3>Método de pago</h3>
                        <img src="/assets/credit-card.png" alt="Tarjeta" width="80">
                    </div>
                    <label>Número de tarjeta</label>
                    <input type="text" class="tarjeta-input" name="card-number" placeholder="1234 5678 9012 3456" required>
                    <div class="tarjeta-info">
                        <div>
                            <label>Vencimiento</label>
                            <input type="text" class="tarjeta-input" name="expiry-date" placeholder="MM/AA" required>
                        </div>
                        <div>
                            <label>CVC</label>
                            <input type="text" class="tarjeta-input" name="cvc" placeholder="123" required>
                        </div>
                    </div>
                    <label>Nombre en la tarjeta</label>
                    <input type="text" class="tarjeta-input" name="card-holder" placeholder="Como aparece en la tarjeta" required>
                    <div class="checkbox-option">
                        <input type="checkbox" id="guardar-tarjeta" name="save-card">
                        <label for="guardar-tarjeta">Guardar este método de pago para futuras reservas</label>
                    </div>
                </div>
                <div class="resumen">
                    <h4>Resumen de Reserva</h4>
                    <p><strong>Auto:</strong> <?php echo $model; ?> (<?php echo $year; ?> - <?php echo $transmission; ?> - <?php echo $fuel; ?>)</p>
                    <p><strong>Recogida:</strong> <?php echo $fecha_recogida; ?> en <?php echo $ubicacion_recogida; ?></p>
                    <p><strong>Devolución:</strong> <?php echo $fecha_devolucion; ?> en <?php echo $ubicacion_devolucion; ?></p>
                    <p><strong>Pago:</strong> <?php echo $pago; ?></p>
                    <p class="total-pago"><strong>Total estimado:</strong> $<?php echo $total; ?></p>
                </div>
                <button type="submit" class="button">Confirmar Pago</button>
            </form>
        </div>
    </div>
</body>
</html>