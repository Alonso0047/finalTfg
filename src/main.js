document.addEventListener('DOMContentLoaded', () => {
    const botonesAbrirCarrito = document.querySelectorAll('[data-accion="abrir-carrito"]');
    const botonesCerrarCarrito = document.querySelectorAll('[data-accion="cerrar-carrito"]');
    const ventanaCarrito = document.getElementById('carrito');
    const btnAgregarAlCarrito = document.getElementById('agregar-al-carrito');
    const carrito = document.getElementById('carrito');
    const carritoFooter = carrito.querySelector('.carrito__footer');
    const carritoFooterTotal = carritoFooter.querySelector('.carrito__contenedor-total');// Botón de comprar
    const producto = document.getElementById('producto');
    let notificacion = document.getElementById('notificacion');

    const formatearMoneda = new Intl.NumberFormat('es-ES', {style: 'currency', currency: 'EUR'});

    const renderCarrito = (carrito) => {
        ventanaCarrito.classList.add('carrito--active');

        // Eliminar todos los productos anteriores para construir el carrito desde cero
        const productosAnteriores = ventanaCarrito.querySelectorAll('.carrito__producto');
        productosAnteriores.forEach((producto) => producto.remove());

        let total = 0;

        // Comprobamos si hay productos
        if (carrito.length < 1) {
            ventanaCarrito.classList.add('carrito--vacio');
        } else {
            // Eliminamos la clase del carrito vacío
            ventanaCarrito.classList.remove('carrito--vacio');
            carrito.forEach((productoCarrito) => {
                total += productoCarrito.precio * productoCarrito.cantidad;

                // Creamos una plantilla del código HTML
                const plantillaProducto = `
                    <div class="carrito__producto">
                        <div class="carrito__producto-info">
                            <img src="${productoCarrito.imagen_url}" alt="" class="carrito__thumb" />
                            <div>
                                <p class="carrito__producto-nombre">
                                    <span class="carrito__producto-cantidad">${productoCarrito.cantidad} x </span>${productoCarrito.nombre}
                                </p>
                                <p class="carrito__producto-propiedades">
                                    Precio: ${formatearMoneda.format(productoCarrito.precio)}
                                </p>
                            </div>
                        </div>
                        <div class="carrito__producto-contenedor-precio">
                            <button class="carrito__btn-eliminar-item" data-accion="eliminar-item-carrito" data-id="${productoCarrito.id_producto}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                                </svg>
                            </button>
                            <p class="carrito__producto-precio">${formatearMoneda.format(productoCarrito.precio * productoCarrito.cantidad)}</p>
                        </div>
                    </div>
                `;

                // Creamos un div
                const itemCarrito = document.createElement('div');
                // Le agregamos la clase carrito producto
                itemCarrito.classList.add('carrito__producto');
                // Insertamos la plantilla
                itemCarrito.innerHTML = plantillaProducto;
                // Agregamos el producto a la ventana producto
                ventanaCarrito.querySelector('.carrito__body').appendChild(itemCarrito);
            });
        }

        ventanaCarrito.querySelector('.carrito__total').innerText = formatearMoneda.format(total);
    };

    botonesAbrirCarrito.forEach((boton) => {
        boton.addEventListener('click', () => {
            fetchCarrito(renderCarrito);
        });
    });

    botonesCerrarCarrito.forEach((boton) => {
        boton.addEventListener('click', () => {
            ventanaCarrito.classList.remove('carrito--active');
        });
    });

    btnAgregarAlCarrito.addEventListener('click', (e) => {
        const id_producto = producto.dataset.productoId;
        const nombre = producto.querySelector('.producto__nombre').innerText;
        const precio = parseFloat(producto.querySelector('.producto__precio').innerText.replace(/[^0-9.-]+/g, ""));
        const cantidad = parseInt(producto.querySelector('#cantidad').value);
        const imagen_url = producto.querySelector('.producto__imagen').src; // Asegúrate de que esta línea esté obteniendo el src correctamente

        const formData = new FormData();
        formData.append('id_producto', id_producto);
        formData.append('nombre', nombre);
        formData.append('precio', precio);
        formData.append('cantidad', cantidad);
        formData.append('imagen_url', imagen_url); // Asegúrate de que este campo esté siendo añadido correctamente

        fetch('../php/agregar_al_carrito.php', {  // Ajustar la ruta si es necesario
            method: 'POST',
            body: formData
        }).then(response => response.text())
          .then(data => {
              // Mostrar notificación o actualizar la UI según sea necesario
              notificacion.innerHTML = `
                  <img src="${imagen_url}" alt="${nombre}" class="notificacion__thumb">
                  <p>${data}</p>
              `;
              notificacion.classList.add('notificacion--active');
              setTimeout(() => {
                  notificacion.classList.remove('notificacion--active');
              }, 5000);
          }).catch(error => console.error('Error:', error));
    });

    // Botón para comprar carrito
    

    // Botones eliminar carrito
    ventanaCarrito.addEventListener('click', (e) => {
        if (e.target.closest('button')?.dataset.accion === 'eliminar-item-carrito') {
            const id = e.target.closest('button').dataset.id;
            fetch(`../php/remove_from_cart.php?id=${id}`, {  // Ajustar la ruta
                method: 'GET'
            }).then(response => response.text())
              .then(data => {
                  // Re-renderizar el carrito después de eliminar el producto
                  fetchCarrito(renderCarrito);
              }).catch(error => console.error('Error:', error));
        }
    });

    const fetchCarrito = (callback) => {
        fetch('../php/fetch_cart.php')  // Ajustar la ruta
            .then(response => response.json())
            .then(data => {
                callback(data);
            })
            .catch(error => console.error('Error:', error));
    };
});
