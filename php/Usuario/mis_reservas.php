<?php
session_start();

if (!isset($_SESSION["usuario"]) || $_SESSION["tipo"] !== "usuario") {
    header("Location: ../../public/login.php");
    exit();
}

include '../conexion.php';

$usuario_id = $_SESSION['usuario_id'];

// Obtener reservas desde MySQL
$sql = "SELECT r.*, v.marca, v.modelo 
        FROM reservas r
        JOIN vehiculos v ON r.vehiculo_id = v.id
        WHERE r.usuario_id = ?
        ORDER BY r.fecha_creacion DESC";
        
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$reservas = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas - AutoGo</title>
    <link rel="stylesheet" href="/public/estilos.css">
</head>
<body>
    <div class="container-home">
        <div class="header">
            <div class="autogo-container">
                <img src="/assets/car-icon.png" alt="Icono de AutoGo" width="75">
                <span class="autogo-text">AutoGo</span>
            </div>
            <div class="nav-links">
                <a href="home.php">Inicio</a>
                <a href="../../logout.php">Cerrar Sesión</a>
            </div>
        </div>

        <h3>Mis Reservas</h3>

        <?php if (count($reservas) > 0): ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Auto</th>
                        <th>Fecha de Recogida</th>
                        <th>Fecha de Devolución</th>
                        <th>Ubicación Recogida</th>
                        <th>Ubicación Devolución</th>
                        <th>Estado</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservas as $reserva): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reserva['marca'] . ' ' . $reserva['modelo']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['fecha_recogida']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['fecha_devolucion']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['ubicacion_recogida']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['ubicacion_devolucion']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['estado']); ?></td>
                            <td>$<?php echo number_format($reserva['total'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No tienes reservas actualmente.</p>
        <?php endif; ?>

        <div class="admin-actions">
            <a href="home.php" class="button">Volver al Inicio</a>
        </div>
    </div>
</body>
</html>