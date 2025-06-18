<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
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
                <a href="/index.html">Cerrar Sesión</a>
            </div>
        </div>

        <form class="reserva-form" action="reserva_pago.php" method="POST">
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
            <select name="pago" class="filter">
                <option value="">Seleccionar</option>
                <option value="debito">Tarjeta de Débito</option>
                <option value="credito">Tarjeta de Crédito</option>
            </select>

            <div class="resumen">
                <h4>Resumen de Reserva</h4>
                <p><strong>Recogida:</strong> --</p>
                <p><strong>Devolución:</strong> --</p>
                <p><strong>Recoger en:</strong> --</p>
                <p><strong>Devolver en:</strong> --</p>
                <p><strong>Pago:</strong> --</p>
                <p><strong>Total estimado:</strong> $---</p>
            </div>

            <button type="submit" class="button">Confirmar Reserva</button>
        </form>
    </div>
</body>
</html>