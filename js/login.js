document.addEventListener('DOMContentLoaded', function() {
    // Login form submission
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = this.querySelector('input[type="email"]').value;
            const password = this.querySelector('input[type="password"]').value;
            
            // Validate email format
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Por favor, introduce un email válido');
                return;
            }
            
            // Validate password (minimum 6 characters)
            if (password.length < 6) {
                alert('La contraseña debe tener al menos 6 caracteres');
                return;
            }
            
            // Here you would typically send this data to a server
            console.log('Login attempt:', { email, password });
            
            // Show success message (for demo purposes)
            alert('Inicio de sesión exitoso!');
            
            // Reset form
            this.reset();
        });
    }
});