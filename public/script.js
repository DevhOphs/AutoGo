function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function validateLogin() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    if (!email || !password) {
        alert('Por favor, completa todos los campos.');
        return false;
    }
    if (!isValidEmail(email)) {
        alert('Por favor, ingresa un correo electrónico válido.');
        return false;
    }
    return true; // Permite el envío del formulario
}

function validateRegister() {
    const nombre = document.getElementById('nombre').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (!nombre || !email || !password || !confirmPassword) {
        alert('Por favor, completa todos los campos.');
        return false;
    }

    if (!isValidEmail(email)) {
        alert('Por favor, ingresa un correo electrónico válido.');
        return false;
    }
    
    if (password !== confirmPassword) {
        alert('Las contraseñas no coinciden.');
        return false;
    }
    return true; // Permite el envío del formulario
}