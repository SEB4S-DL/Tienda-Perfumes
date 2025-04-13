// Search functionality
document.addEventListener("DOMContentLoaded", () => {
    const searchButton = document.querySelector(".search-button")
    const searchInput = document.querySelector(".search-container input")
  
    searchButton.addEventListener("click", (e) => {
      e.preventDefault()
      if (searchInput.value.trim() !== "") {
        // In a real implementation, this would redirect to search results
        alert(`Buscando: ${searchInput.value}`)
        // searchInput.value = '';
      }
    })
  
    // Allow search on Enter key press
    searchInput.addEventListener("keypress", (e) => {
      if (e.key === "Enter" && searchInput.value.trim() !== "") {
        e.preventDefault()
        // In a real implementation, this would redirect to search results
        alert(`Buscando: ${searchInput.value}`)
        // searchInput.value = '';
      }
    })
  
    // Navigation active state
    const navLinks = document.querySelectorAll("nav ul li a")
    navLinks.forEach((link) => {
      link.addEventListener("click", function () {
        navLinks.forEach((l) => l.classList.remove("active"))
        this.classList.add("active")
      })
    })
  })
  