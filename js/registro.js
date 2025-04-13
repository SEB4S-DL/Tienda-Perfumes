document.addEventListener('DOMContentLoaded', function() {
    // Registration form submission
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const fullName = this.querySelector('input[placeholder="Nombre Completo"]').value;
            const email = this.querySelector('input[type="email"]').value;
            const address = this.querySelector('input[placeholder="Dirección"]').value;
            const password = this.querySelectorAll('input[type="password"]')[0].value;
            const confirmPassword = this.querySelectorAll('input[type="password"]')[1].value;
            
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
            
            // Validate passwords match
            if (password !== confirmPassword) {
                alert('Las contraseñas no coinciden');
                return;
            }
            
            // Here you would typically send this data to a server
            console.log('Registration data:', { 
                fullName, 
                email, 
                address, 
                password 
            });
            
            // Show success message (for demo purposes)
            alert('Registro exitoso!');
            
            // Reset form
            this.reset();
        });
    }
});