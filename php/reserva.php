<?php
// Recuperar parámetros GET
$car_id = isset($_GET['car_id']) ? htmlspecialchars($_GET['car_id']) : '';
$model = isset($_GET['model']) ? htmlspecialchars($_GET['model']) : 'No seleccionado';
$year = isset($_GET['year']) ? htmlspecialchars($_GET['year']) : '';
$transmission = isset($_GET['transmission']) ? htmlspecialchars($_GET['transmission']) : '';
$fuel = isset($_GET['fuel']) ? htmlspecialchars($_GET['fuel']) : '';
$price = isset($_GET['price']) ? htmlspecialchars($_GET['price']) : '0';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoGo - Reserva</title>
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
        <form class="reserva-form" action="reserva_pago.php" method="POST">
            <!-- Campos ocultos para los datos del auto -->
            <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
            <input type="hidden" name="model" value="<?php echo $model; ?>">
            <input type="hidden" name="year" value="<?php echo $year; ?>">
            <input type="hidden" name="transmission" value="<?php echo $transmission; ?>">
            <input type="hidden" name="fuel" value="<?php echo $fuel; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">
            <!-- Campos del formulario -->
            <div class="form-row">
                <div>
                    <label>Fecha y Hora de Recogida</label>
                    <input type="datetime-local" name="fecha_recogida" required>
                </div>
                <div>
                    <label>Ubicación de Recogida</label>
                    <input type="text" name="ubicacion_recogida" required>
                </div>
            </div>
            <div class="form-row">
                <div>
                    <label>Fecha y Hora de Devolución</label>
                    <input type="datetime-local" name="fecha_devolucion" required>
                </div>
                <div>
                    <label>Ubicación de Devolución</label>
                    <input type="text" name="ubicacion_devolucion" required>
                </div>
            </div>
            <label>Método de Pago</label>
            <select name="pago" class="filter" required>
                <option value="">Seleccionar</option>
                <option value="debito">Tarjeta de Débito</option>
                <option value="credito">Tarjeta de Crédito</option>
            </select>
            <div class="resumen">
                <h4>Resumen de Reserva</h4>
                <p><strong>Auto:</strong> <?php echo $model; ?> (<?php echo $year; ?> - <?php echo $transmission; ?> - <?php echo $fuel; ?>)</p>
                <p><strong>Precio por día:</strong> $<?php echo $price; ?></p>
                <p><strong>Recogida:</strong> --</p>
                <p><strong>Devolución:</strong> --</p>
                <p><strong>Recoger en:</strong> --</p>
                <p><strong>Devolver en:</strong> --</p>
                <p><strong>Pago:</strong> --</p>
                <p><strong>Total estimado:</strong> $--</p>
            </div>
            <button type="submit" class="button">Confirmar Reserva</button>
        </form>
    </div>
</body>
</html>