document.addEventListener('DOMContentLoaded', function() {
    // Status dropdown functionality
    const statusDropdown = document.querySelector('.status-dropdown');
    const statusText = statusDropdown.querySelector('span');
    
    statusDropdown.addEventListener('click', function() {
        // In a real application, this would show a dropdown menu
        const statuses = ['Pendiente', 'En proceso', 'Enviado', 'Entregado', 'Cancelado'];
        const currentIndex = statuses.indexOf(statusText.textContent);
        const nextIndex = (currentIndex + 1) % statuses.length;
        
        // Update the status text (for demo purposes)
        statusText.textContent = statuses[nextIndex];
    });
    
    // Change status button functionality
    const changeStatusBtn = document.querySelector('.status-btn');
    changeStatusBtn.addEventListener('click', function() {
        const newStatus = statusDropdown.querySelector('span').textContent;
        
        // In a real application, this would update the status in the database
        console.log('Changing order status to:', newStatus);
        alert(`Estado del pedido actualizado a: ${newStatus}`);
    });
    
    // Fix product images
    const productImages = document.querySelectorAll('.product-image img');
    
    // First product image (Luis XV 1722)
    productImages[0].src = 'https://i.imgur.com/JYgGJwJ.jpg';
    
    // Second product image (Hierba pura)
    productImages[1].src = 'https://i.imgur.com/Ql4FGhK.jpg';
    
    // Search functionality
    const searchInput = document.querySelector('.search-container input');
    const searchBtn = document.querySelector('.search-btn');
    
    searchBtn.addEventListener('click', function() {
        performSearch();
    });
    
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
    
    function performSearch() {
        const searchTerm = searchInput.value.trim();
        if (searchTerm) {
            console.log('Searching for:', searchTerm);
            // This would typically trigger a search API call
            alert(`Buscando: ${searchTerm}`);
        }
    }
    
    // Fix user profile image
    const userProfileImg = document.querySelector('.user-profile img');
    userProfileImg.src = 'https://randomuser.me/api/portraits/men/32.jpg';
});