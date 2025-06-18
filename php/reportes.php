<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=200.0">
    <title>AutoGo - Panel de Reportes</title>
    <link rel="stylesheet" href="../public/estilos.css">
</head>
<body class="autos">
    <div class="container-home">
        <div class="header">
            <div class="autogo-container">
                <img src="../assets/car-icon.png" alt="Icono de Auto" width="75">
                <span class="autogo-text">AutoGo</span>
            </div>
            <div>
                <a href="home.php" class="header-link">Inicio</a>
                <a href="login.php" class="header-link">Iniciar Sesión</a>
                <a href="register.php" class="header-link">Registrarse</a>
            </div>
        </div>

        <h3>Panel de Reportes</h3>
        <p>Tu auto ideal, al instante</p>

        <div class="report-cards">
            <div class="report-card">
                <div class="icon-placeholder">📅</div>
                <h4>Reservas</h4>
                <p>245</p>
                <p>En el período seleccionado</p>
            </div>
            <div class="report-card">
                <div class="icon-placeholder">💰</div>
                <h4>Ingresos</h4>
                <p>$52,800</p>
                <p>USD en período</p>
            </div>
            <div class="report-card">
                <div class="icon-placeholder">🔧</div>
                <h4>En Mantenimiento</h4>
                <p>8</p>
                <p>Vehículos actualmente</p>
            </div>
        </div>

        <div class="charts-container">
            <div class="chart-card">
                <h4>Reservas por día</h4>
                <img src="/assets/grafico_barras.png" alt="Gráfico de Reservas por Día" class="chart-placeholder">
            </div>
            <div class="chart-card">
                <h4>Estado de la Flota</h4>
                <img src="/assets/grafico_circular.png" alt="Gráfico de Estado de la Flota" class="chart-placeholder">
            </div>
        </div>
    </div>
</body>
</html>