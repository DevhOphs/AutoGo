<?php
session_start();

if (!isset($_SESSION["usuario"]) || $_SESSION["tipo"] !== "admin") {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

// Datos estadistica
$sql_vehiculos = "SELECT COUNT(*) as total FROM vehiculos";
$result_vehiculos = $conexion->query($sql_vehiculos);
$total_vehiculos = $result_vehiculos->fetch_assoc()['total'];

$sql_reservas = "SELECT COUNT(*) as total FROM reservas";
$result_reservas = $conexion->query($sql_reservas);
$reservation_count = $result_reservas->fetch_assoc()['total'];

$sql_ingresos = "SELECT SUM(total) as total FROM reservas";
$result_ingresos = $conexion->query($sql_ingresos);
$income = $result_ingresos->fetch_assoc()['total'] ?? 0;

$sql_mantenimiento = "SELECT COUNT(*) as total FROM vehiculos WHERE estado = 'mantenimiento'";
$result_mantenimiento = $conexion->query($sql_mantenimiento);
$maintenance_count = $result_mantenimiento->fetch_assoc()['total'];

// Datos para gráfico de barras (reservas por día - simulación)
$reservations_labels = ['2025-06-30', '2025-07-01', '2025-07-02'];
$reservations_data = [rand(5, 15), rand(5, 15), rand(5, 15)];

// Datos para gráfico circular (estado de la flota)
$sql_estados = "SELECT estado, COUNT(*) as count FROM vehiculos GROUP BY estado";
$result_estados = $conexion->query($sql_estados);
$fleet_labels = [];
$fleet_data = [];
while ($row = $result_estados->fetch_assoc()) {
    $fleet_labels[] = $row['estado'];
    $fleet_data[] = $row['count'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - AutoGo</title>
    <link rel="stylesheet" href="../../public/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
</head>
<body>
    <div class="container-home">
        <div class="header">
            <div class="autogo-container">
                <img src="../../assets/car-icon.png" alt="Icono de AutoGo" width="75">
                <span class="autogo-text">AutoGo</span>
            </div>
            <div class="nav-links">
                <a href="inventario.php" class="header-link">Inventario</a>
                <a href="reservas.php" class="header-link">Reservas</a>
                <a href="/../../logout.php" class="header-link">Cerrar Sesión</a>
            </div>
        </div>

        <h3>Panel de Administración</h3>
        <p>Tu auto ideal, al instante</p>

        <div class="report-cards">
            <div class="report-card">
                <div class="icon-placeholder">📅</div>
                <h4>Reservas</h4>
                <p><?php echo $reservation_count; ?></p>
                <p>En el período seleccionado</p>
            </div>
            <div class="report-card">
                <div class="icon-placeholder">💰</div>
                <h4>Ingresos</h4>
                <p>$<?php echo number_format($income, 2); ?></p>
                <p>USD en período</p>
            </div>
            <div class="report-card">
                <div class="icon-placeholder">🔧</div>
                <h4>En Mantenimiento</h4>
                <p><?php echo $maintenance_count; ?></p>
                <p>Vehículos actualmente</p>
            </div>
        </div>

        <div class="charts-container">
            <div class="chart-card">
                <h4>Reservas por Día</h4>
                <div class="chart-container">
                    <canvas id="reservationsChart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="chart-card">
                <h4>Estado de la Flota</h4>
                <div class="chart-container">
                    <canvas id="fleetChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="admin-actions">
            <a href="agregar_vehiculo.php" class="button">Agregar Vehículo</a>
            <a href="inventario.php" class="button">Ver Inventario</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Chart(document.getElementById('reservationsChart'), {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($reservations_labels); ?>,
                    datasets: [{
                        label: 'Reservas por Día',
                        data: <?php echo json_encode($reservations_data); ?>,
                        backgroundColor: '#007bff',
                        borderColor: '#0056b3',
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } },
                    plugins: { legend: { display: true } }
                }
            });

            new Chart(document.getElementById('fleetChart'), {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode($fleet_labels); ?>,
                    datasets: [{
                        data: <?php echo json_encode($fleet_data); ?>,
                        backgroundColor: ['#007bff', '#28a745', '#dc3545'],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    aspectRatio: 1,
                    plugins: { legend: { display: true } }
                }
            });
        });
    </script>
</body>
</html>