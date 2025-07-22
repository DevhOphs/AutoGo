<?php
session_start();

if (!isset($_SESSION["usuario"]) || $_SESSION["tipo"] !== "admin") {
    header("Location: ../public/login.php");
    exit();
}

include '../conexion.php';

// Obtener reservas desde la base de datos
$sql = "SELECT r.*, u.email, v.marca, v.modelo 
        FROM reservas r
        JOIN usuarios u ON r.usuario_id = u.id
        JOIN vehiculos v ON r.vehiculo_id = v.id
        ORDER BY r.fecha_creacion DESC";
$result = $conexion->query($sql);
$reservations = $result->fetch_all(MYSQLI_ASSOC);

// Procesar eliminación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt = $conexion->prepare("DELETE FROM reservas WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    header("Location: reservas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas - AutoGo Admin</title>
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
                <a href="homeAdmin.php">Inicio</a>
                <a href="/public/logout.php">Cerrar Sesión</a>
            </div>
        </div>

        <h3>Reservas</h3>

        <?php if (count($reservations) > 0): ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Auto</th>
                        <th>Fecha de Recogida</th>
                        <th>Fecha de Devolución</th>
                        <th>Ubicación Recogida</th>
                        <th>Ubicación Devolución</th>
                        <th>Estado</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reservation['email']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['marca'] . ' ' . $reservation['modelo']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['fecha_recogida']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['fecha_devolucion']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['ubicacion_recogida']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['ubicacion_devolucion']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['estado']); ?></td>
                            <td>$<?php echo number_format($reservation['total'], 2); ?></td>
                            <td>
                                <form method="POST" style="margin: 0;">
                                    <input type="hidden" name="delete_id" value="<?php echo $reservation['id']; ?>">
                                    <button type="submit" class="delete-btn">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay reservas registradas actualmente.</p>
        <?php endif; ?>

        <div class="admin-actions">
            <a href="homeAdmin.php" class="button">Volver al Inicio</a>
        </div>
    </div>
</body>
</html>