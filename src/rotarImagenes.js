document.addEventListener("DOMContentLoaded", function() {
    var imagenes = ['../imagenes/coche2.jpg', '../imagenes/coche3.png', '../imagenes/coche4.jpg']; // Lista de nombres de las imágenes
    var indice = 0; // Índice actual de la imagen
  
    var imagen = document.getElementById('imagen-cambiante');
  
    // Función para cambiar la imagen cada cierto tiempo (en milisegundos)
    setInterval(function() {
      indice = (indice + 1) % imagenes.length; // Asegura que el índice esté dentro del rango de imágenes
      imagen.style.left = "-100%"; // Desplaza la imagen hacia la izquierda
      setTimeout(function() {
        imagen.src = imagenes[indice]; // Cambia la imagen después de la transición
        imagen.style.left = "0"; // Vuelve a colocar la imagen en su posición original
      }, 500); // Espera 500 milisegundos antes de cambiar la imagen, ajusta este valor para que coincida con la duración de la transición en CSS
    }, 3000); // Cambia la imagen cada 3 segundos (3000 milisegundos)
  });