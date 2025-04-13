const inputImagen = document.getElementById('imagen');
const nombreImagen = document.getElementById('nombre-imagen');

inputImagen.addEventListener('change', () => {
  if (inputImagen.files.length > 0) {
    nombreImagen.textContent = inputImagen.files[0].name;
  } else {
    nombreImagen.textContent = 'No hay imagen cargada';
  }
});

document.getElementById('form-editar-producto').addEventListener('submit', (e) => {
  e.preventDefault();
  alert('Producto guardado correctamente (simulado)');
});
