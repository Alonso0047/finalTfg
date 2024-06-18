// Obtener elementos del DOM
const carrito = document.getElementById('carrito');
const carritoFooter = carrito.querySelector('.carrito__footer');
const carritoFooterTotal = carritoFooter.querySelector('.carrito__contenedor-total');
const boton = carritoFooterTotal.querySelector('.carrito__btn-comprar');
const notificacion = document.getElementById('notificacion');

// Función para obtener los datos del carrito
const fetchCarrito = (callback) => {
    fetch('../php/fetch_cart.php')  // Ajustar la ruta
        .then(response => response.json())
        .then(data => {
            callback(data);
        })
        .catch(error => console.error('Error:', error));
};

// Función para enviar el pedido al servidor
const enviarPedido = () => {
    fetchCarrito((carrito) => {
        const formData = new FormData();
        formData.append('carrito', JSON.stringify(carrito));

        fetch('../php/agregar_pedido.php', {  // Ruta del nuevo archivo PHP
            method: 'POST',
            body: formData
        }).then(response => response.text())
          .then(data => {
              // Mostrar notificación o redirigir a la página de confirmación
              notificacion.innerHTML = `<p>${data}</p>`;
              notificacion.classList.add('notificacion--active');
              setTimeout(() => {
                  notificacion.classList.remove('notificacion--active');
              }, 5000);
          }).catch(error => console.error('Error:', error));
    });
};

// Registrar evento click para el botón de comprar
boton.addEventListener('click', enviarPedido);
