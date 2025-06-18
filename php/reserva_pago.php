<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
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
                <a href="/index.html">Cerrar Sesión</a>
            </div>
        </div>

        <div class="pago-container">
            <h2>Pago Seguro</h2>
            <p>Tu auto ideal, al máximo</p>
            
            <form action="home.php" method="POST">
                <div class="tarjeta-section">
    <h3>Método de pago</h3>
    <img src="/assets/credit-card.png" alt="Tarjeta">
    
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
        <label for="guardar-tarjeta">Guardar este método de pago</label> 
        <input type="checkbox" id="guardar-tarjeta" name="save-card">
    </div>
</div>

                
                <div class="resumen">
                    <h4>Resumen de Reserva</h4>
                    <p><span>Recogida:</span> 03/06/2024 09:00</p>
                    <p><span>Devolución:</span> 07/06/2024 17:00</p>
                    <p><span>Recoger en:</span> Aeropuerto Guayaquil</p>
                    <p><span>Devolver en:</span> Juan Tanca Marengo R.</p>
                    <p><span>Vehículo:</span> Toyota Corolla 2023</p>
                    <p class="total-pago"><span>Total a pagar:</span> $1,150</p>
                </div>
                
                <button type="submit" class="button">Confirmar Pago</button>
            </form>
        </div>
    </div>
</body>
</html>