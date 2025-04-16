document.addEventListener("DOMContentLoaded", () => {
    fetch("../backend/pedidos.php")
      .then(response => response.text())
      .then(html => {
        document.querySelector("#tablaPedidos tbody").innerHTML = html;
      })
      .catch(error => {
        console.error("Error al cargar los pedidos:", error);
        document.querySelector("#tablaPedidos tbody").innerHTML =
          "<tr><td colspan='4'>No se pudieron cargar los pedidos.</td></tr>";
      });
  });
  