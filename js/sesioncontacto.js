// Funcionalidad para el botón de búsqueda
document.addEventListener("DOMContentLoaded", () => {
    const searchBtn = document.querySelector(".search-btn")
    const searchInput = document.querySelector(".search-container input")
  
    searchBtn.addEventListener("click", (e) => {
      e.preventDefault()
      if (searchInput.value.trim() !== "") {
        alert("Buscando: " + searchInput.value)
        // Aquí iría la lógica real de búsqueda
        searchInput.value = ""
      }
    })
  
    // Permitir búsqueda al presionar Enter
    searchInput.addEventListener("keypress", (e) => {
      if (e.key === "Enter" && searchInput.value.trim() !== "") {
        e.preventDefault()
        alert("Buscando: " + searchInput.value)
        // Aquí iría la lógica real de búsqueda
        searchInput.value = ""
      }
    })
  })
  