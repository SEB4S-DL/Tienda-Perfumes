document.addEventListener("DOMContentLoaded", () => {
    cargarCarrito();
  
    window.vaciarCarrito = () => {
      fetch("../backend/carrito.php?vaciar=1")
        .then(() => cargarCarrito());
    };
  
    window.actualizarCarrito = (accion, id) => {
      fetch(`../backend/carrito.php?${accion}=${id}`)
        .then(() => cargarCarrito());
    };
  
    function cargarCarrito() {
      fetch("../backend/carrito.php")
        .then(res => res.text())
        .then(html => {
          document.getElementById("cart-items").innerHTML = html;
  
          const totalSpan = document.getElementById("total");
          const match = html.match(/data-total="(\d+)"/);
          if (match) {
            const total = parseInt(match[1]);
            totalSpan.textContent = `Precio Total: $${total.toLocaleString('es-CO')} COP`;
          } else {
            totalSpan.textContent = "Precio Total: $0 COP";
          }
        });
    }
  });
  