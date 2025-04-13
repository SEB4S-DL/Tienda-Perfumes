const pedidos = [
    { id: 2, precio: "344,000 COP", fecha: "12-04-2025", estado: "Pendiente" },
    { id: 1, precio: "450,000 COP", fecha: "11-04-2025", estado: "Pendiente" }
  ];
  
  const tbody = document.querySelector("#tablaPedidos tbody");
  
  pedidos.forEach(pedido => {
    const row = document.createElement("tr");
  
    row.innerHTML = `
      <td>${pedido.id}</td>
      <td>${pedido.precio}</td>
      <td>${pedido.fecha}</td>
      <td>${pedido.estado}</td>
    `;
  
    tbody.appendChild(row);
  });
  