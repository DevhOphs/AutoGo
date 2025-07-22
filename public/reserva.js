document.addEventListener('DOMContentLoaded', function() {
    const fechaRecogida = document.getElementById('fecha_recogida');
    const ubicacionRecogida = document.getElementById('ubicacion_recogida');
    const fechaDevolucion = document.getElementById('fecha_devolucion');
    const ubicacionDevolucion = document.getElementById('ubicacion_devolucion');
    const pago = document.getElementById('pago');
    const resumenRecogida = document.getElementById('resumen-recogida');
    const resumenDevolucion = document.getElementById('resumen-devolucion');
    const resumenRecogerEn = document.getElementById('resumen-recoger-en');
    const resumenDevolverEn = document.getElementById('resumen-devolver-en');
    const resumenPago = document.getElementById('resumen-pago');
    const resumenTotal = document.getElementById('resumen-total');
    const dailyPrice = parseFloat(document.getElementById('daily-price').value);

    function updateSummary() {
        resumenRecogida.textContent = fechaRecogida.value || '--';
        resumenDevolucion.textContent = fechaDevolucion.value || '--';
        resumenRecogerEn.textContent = ubicacionRecogida.value || '--';
        resumenDevolverEn.textContent = ubicacionDevolucion.value || '--';
        resumenPago.textContent = pago.value ? (pago.value === 'debito' ? 'Tarjeta de Débito' : 'Tarjeta de Crédito') : '--';

        if (fechaRecogida.value && fechaDevolucion.value) {
            const date1 = new Date(fechaRecogida.value);
            const date2 = new Date(fechaDevolucion.value);
            if (date2 > date1) {
                const diffTime = Math.abs(date2 - date1);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                const total = diffDays * dailyPrice;
                resumenTotal.textContent = `$${total.toFixed(2)}`;
            } else {
                resumenTotal.textContent = 'Fechas inválidas';
            }
        } else {
            resumenTotal.textContent = '$--';
        }
    }

    // Agregar event listeners
    fechaRecogida.addEventListener('input', updateSummary);
    ubicacionRecogida.addEventListener('input', updateSummary);
    fechaDevolucion.addEventListener('input', updateSummary);
    ubicacionDevolucion.addEventListener('input', updateSummary);
    pago.addEventListener('change', updateSummary);

    // Actualizar inicialmente
    updateSummary();
});