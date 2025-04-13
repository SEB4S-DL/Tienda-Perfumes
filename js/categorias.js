document.addEventListener('DOMContentLoaded', function() {
    // Modal functionality
    const modal = document.getElementById('categoryModal');
    const addBtn = document.querySelector('.add-btn');
    const closeModal = document.querySelector('.close-modal');
    const modalTitle = document.getElementById('modalTitle');
    const categoryForm = document.getElementById('categoryForm');
    const categoryNameInput = document.getElementById('categoryName');
    
    // Open modal for adding a new category
    addBtn.addEventListener('click', function() {
        modalTitle.textContent = 'Agregar Categoría';
        categoryNameInput.value = '';
        modal.style.display = 'flex';
    });
    
    // Close modal when clicking the X
    closeModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });
    
    // Close modal when clicking outside the modal content
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
    
    // Handle form submission
    categoryForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const categoryName = categoryNameInput.value.trim();
        
        if (categoryName) {
            console.log('Category saved:', categoryName);
            // Here you would typically save the category to a database
            
            // Close the modal
            modal.style.display = 'none';
            
            // Show success message
            alert(`Categoría "${categoryName}" guardada exitosamente`);
        }
    });
    
    // Edit button functionality
    const editBtns = document.querySelectorAll('.edit-btn');
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const categoryId = row.cells[0].textContent;
            const categoryName = row.cells[1].textContent;
            
            // Populate the form with existing data
            modalTitle.textContent = 'Editar Categoría';
            categoryNameInput.value = categoryName;
            
            // Open the modal
            modal.style.display = 'flex';
            
            console.log('Editing category:', categoryId, categoryName);
        });
    });
    
    // Delete button functionality
    const deleteBtns = document.querySelectorAll('.delete-btn');
    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const categoryId = row.cells[0].textContent;
            const categoryName = row.cells[1].textContent;
            
            if (confirm(`¿Está seguro que desea eliminar la categoría "${categoryName}"?`)) {
                console.log('Deleting category:', categoryId, categoryName);
                // Here you would typically delete the category from a database
                
                // Remove the row from the table (for demo purposes)
                row.remove();
                
                // Show success message
                alert(`Categoría "${categoryName}" eliminada exitosamente`);
            }
        });
    });
    
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