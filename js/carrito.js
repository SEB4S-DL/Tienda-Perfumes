const productos = [
    {
        nombre: "Dolce & Gabbana The One",
        precio: 344000,
        cantidad: 1,
        imagen: "img/theone.jpg"
    },
    {
        nombre: "Gabrielle Chanel Paris",
        precio: 450000,
        cantidad: 1,
        imagen: "img/chanel.jpg"
    }
];

function cargarCarrito() {
    const contenedor = document.getElementById("cart-items");
    contenedor.innerHTML = "";
    let total = 0;

    productos.forEach((producto, index) => {
        const item = document.createElement("div");
        item.className = "cart-item";
        item.innerHTML = `
            <img src="${producto.imagen}" alt="${producto.nombre}">
            <div class="cart-info">
                <h3>${producto.nombre}</h3>
            </div>
            <div class="cart-price">${producto.precio.toLocaleString()} COP</div>
            <div class="cart-qty">+${producto.cantidad}</div>
            <button class="btn delete" onclick="eliminarProducto(${index})">ELIMINAR</button>
        `;
        contenedor.appendChild(item);
        total += producto.precio * producto.cantidad;
    });

    document.getElementById("total").textContent = `Precio Total: $${total.toLocaleString()} COP`;
}

function eliminarProducto(index) {
    productos.splice(index, 1);
    cargarCarrito();
}

function vaciarCarrito() {
    productos.length = 0;
    cargarCarrito();
}

window.onload = cargarCarrito;
