document.addEventListener('DOMContentLoaded', function() {
    // Fix product images
    const productImages = document.querySelectorAll('.product-image');
    
    // First product image (Dolce & Gabbana The One)
    productImages[0].src = 'https://i.imgur.com/8BZvZg0.jpg';
    
    // Second product image (Gabrielle Chanel Paris)
    productImages[1].src = 'https://i.imgur.com/Ql4FGhK.jpg';
    
    // Delete button functionality
    const deleteBtns = document.querySelectorAll('.delete-btn');
    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const productName = row.querySelector('.product-name').textContent;
            const productVariant = row.querySelector('.product-variant').textContent;
            const productPrice = row.querySelector('.product-price-col').textContent;
            
            if (confirm(`¿Está seguro que desea eliminar ${productName} ${productVariant} del carrito?`)) {
                // Remove the product from the cart
                row.remove();
                
                // Update the total price
                updateTotalPrice();
                
                // Show confirmation message
                alert(`${productName} ${productVariant} eliminado del carrito`);
            }
        });
    });
    
    // Empty cart button functionality
    const emptyCartBtn = document.querySelector('.empty-cart-btn');
    emptyCartBtn.addEventListener('click', function() {
        if (confirm('¿Está seguro que desea vaciar el carrito?')) {
            // Remove all products from the cart
            const productRows = document.querySelectorAll('.cart-table tbody tr');
            productRows.forEach(row => {
                row.remove();
            });
            
            // Update the total price
            updateTotalPrice();
            
            // Show confirmation message
            alert('Carrito vaciado exitosamente');
        }
    });
    
    // Checkout button functionality
    const checkoutBtn = document.querySelector('.checkout-btn');
    checkoutBtn.addEventListener('click', function() {
        const totalPrice = document.querySelector('.total-price').textContent;
        
        // Check if the cart is empty
        const productRows = document.querySelectorAll('.cart-table tbody tr');
        if (productRows.length === 0) {
            alert('El carrito está vacío. Agregue productos antes de realizar el pedido.');
            return;
        }
        
        // Proceed to checkout
        alert(`Procesando pedido por ${totalPrice}. Redirigiendo al pago...`);
        // Here you would typically redirect to a checkout page
    });
    
    // Function to update the total price
    function updateTotalPrice() {
        const productRows = document.querySelectorAll('.cart-table tbody tr');
        let total = 0;
        
        productRows.forEach(row => {
            const priceText = row.querySelector('.product-price-col').textContent;
            const price = parseInt(priceText.replace(/[^0-9]/g, ''));
            total += price;
        });
        
        // Format the total price
        const formattedTotal = total.toLocaleString('es-CO') + ' COP';
        
        // Update the total price display
        document.querySelector('.total-price').textContent = formattedTotal;
    }
    
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
});