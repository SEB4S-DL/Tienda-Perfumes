document.addEventListener('DOMContentLoaded', function() {
    // Quantity selector functionality
    const minusBtn = document.querySelector('.minus-btn');
    const plusBtn = document.querySelector('.plus-btn');
    const quantityValue = document.querySelector('.quantity-value');
    let quantity = 2; // Initial value
    
    minusBtn.addEventListener('click', function() {
        if (quantity > 1) {
            quantity--;
            quantityValue.textContent = quantity;
        }
    });
    
    plusBtn.addEventListener('click', function() {
        quantity++;
        quantityValue.textContent = quantity;
    });
    
    // Add to cart functionality
    const addToCartBtn = document.querySelector('.add-to-cart-btn');
    addToCartBtn.addEventListener('click', function() {
        const productName = document.querySelector('.product-title').textContent;
        const price = document.querySelector('.price').textContent;
        
        // Here you would typically send this data to a cart system
        console.log('Added to cart:', {
            product: productName,
            price: price,
            quantity: quantity
        });
        
        // Show confirmation message
        alert(`${productName} (${quantity} unidades) agregado al carrito`);
    });
    
    // Close button functionality
    const closeButton = document.querySelector('.close-button');
    closeButton.addEventListener('click', function() {
        // In a real application, this would close the modal
        // For this demo, we'll just log a message
        console.log('Modal closed');
        alert('Detalle de producto cerrado');
    });
});