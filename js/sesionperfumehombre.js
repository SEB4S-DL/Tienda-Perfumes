document.addEventListener("DOMContentLoaded", () => {
    // Funcionalidad para los botones de color
    const colorOptions = document.querySelectorAll(".color-option")
  
    colorOptions.forEach((option) => {
      option.addEventListener("click", function () {
        // Eliminar la clase active de todos los botones del mismo grupo
        const parentDiv = this.closest(".color-options")
        parentDiv.querySelectorAll(".color-option").forEach((btn) => {
          btn.classList.remove("active")
        })
  
        // Añadir la clase active al botón seleccionado
        this.classList.add("active")
      })
    })
  
    // Funcionalidad para el botón de compra
    const buyButtons = document.querySelectorAll(".buy-button")
  
    buyButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const productName = this.closest(".product-card").querySelector("h3").textContent
        alert(`Has añadido "${productName}" a tu carrito de compras.`)
      })
    })
  
    // Funcionalidad para la barra de búsqueda
    const searchBar = document.querySelector(".search-bar")
    const searchInput = searchBar.querySelector("input")
    const searchButton = searchBar.querySelector("button")
  
    searchButton.addEventListener("click", () => {
      performSearch()
    })
  
    searchInput.addEventListener("keypress", (e) => {
      if (e.key === "Enter") {
        performSearch()
      }
    })
  
    function performSearch() {
      const searchTerm = searchInput.value.trim().toLowerCase()
      if (searchTerm) {
        alert(`Buscando: ${searchTerm}`)
        // Aquí iría la lógica real de búsqueda
        searchInput.value = ""
      }
    }
  })
  