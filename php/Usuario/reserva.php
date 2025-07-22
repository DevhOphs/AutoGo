<?php
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["tipo"] !== "usuario") {
    header("Location: ../login.php");
    exit();
}

// Recuperar parámetros GET provenientes de home
$car_id = isset($_GET['car_id']) ? htmlspecialchars($_GET['car_id']) : '';
$model = isset($_GET['model']) ? htmlspecialchars($_GET['model']) : 'No seleccionado';
$year = isset($_GET['year']) ? htmlspecialchars($_GET['year']) : '';
$transmission = isset($_GET['transmission']) ? htmlspecialchars($_GET['transmission']) : '';
$fuel = isset($_GET['fuel']) ? htmlspecialchars($_GET['fuel']) : '';
$price = isset($_GET['price']) ? floatval($_GET['price']) : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoGo - Reserva</title>
    <link rel="stylesheet" href="/public/estilos.css">
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
                <a href="../../logout.php">Cerrar Sesión</a>
            </div>
        </div>
        <form class="reserva-form" action="pago.php" method="POST">
            <!-- datos del auto -->
            <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
            <input type="hidden" name="model" value="<?php echo $model; ?>">
            <input type="hidden" name="year" value="<?php echo $year; ?>">
            <input type="hidden" name="transmission" value="<?php echo $transmission; ?>">
            <input type="hidden" name="fuel" value="<?php echo $fuel; ?>">
            <input type="hidden" id="daily-price" name="price" value="<?php echo $price; ?>">
            <!-- Campos del formulario -->
            <div class="form-row">
                <div>
                    <label for="fecha_recogida">Fecha y Hora de Recogida</label>
                    <input type="datetime-local" id="fecha_recogida" name="fecha_recogida" required>
                </div>
                <div>
                    <label for="ubicacion_recogida">Ubicación de Recogida</label>
                    <input type="text" id="ubicacion_recogida" name="ubicacion_recogida" required>
                </div>
            </div>
            <div class="form-row">
                <div>
                    <label for="fecha_devolucion">Fecha y Hora de Devolución</label>
                    <input type="datetime-local" id="fecha_devolucion" name="fecha_devolucion" required>
                </div>
                <div>
                    <label for="ubicacion_devolucion">Ubicación de Devolución</label>
                    <input type="text" id="ubicacion_devolucion" name="ubicacion_devolucion" required>
                </div>
            </div>
            <label for="pago">Método de Pago</label>
            <select id="pago" name="pago" class="filter" required>
                <option value="">Seleccionar</option>
                <option value="debito">Tarjeta de Débito</option>
                <option value="credito">Tarjeta de Crédito</option>
            </select>
            <div class="resumen">
                <h4>Resumen de Reserva</h4>
                <p><strong>Auto:</strong> <?php echo $model; ?> (<?php echo $year; ?> - <?php echo $transmission; ?> - <?php echo $fuel; ?>)</p>
                <p><strong>Precio por día:</strong> $<?php echo $price; ?></p>
                <p><strong>Recogida:</strong> <span id="resumen-recogida">--</span></p>
                <p><strong>Devolución:</strong> <span id="resumen-devolucion">--</span></p>
                <p><strong>Recoger en:</strong> <span id="resumen-recoger-en">--</span></p>
                <p><strong>Devolver en:</strong> <span id="resumen-devolver-en">--</span></p>
                <p><strong>Pago:</strong> <span id="resumen-pago">--</span></p>
                <p><strong>Total estimado:</strong> <span id="resumen-total">$--</span></p>
            </div>
            <button type="submit" class="button">Confirmar Reserva</button>
        </form>
    </div>
    <script src="/public/reserva.js"></script>
</body>
</html>