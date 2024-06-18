const producto = document.getElementById('producto');
const productoImagen= producto.querySelector('.producto__imagen');
const thumbs = producto.querySelector('.producto__thumbs');

//Color


//Cantidad

const btnDisminuirCantidad = producto.querySelector('#disminuir-cantidad');
const btnIncrementarCantidad = producto.querySelector('#incrementar-cantidad');
const inputCantidad = producto.querySelector('#cantidad');

//Funcionalidad thums
thumbs.addEventListener('click',(e)=>{
    if(e.target.tagName==='IMG'){
        //Para obtener una imagen del html y la carpeta y colocarla donde indiquemos
        const imagenSRC = e.target.src;
        const lastIndex = imagenSRC.lastIndexOf('/');
        //Cortamos la cadena de texto para obtener solamente una parte
        const nombreImagen = imagenSRC.substring(lastIndex+1);
        productoImagen.src=`./img/tennis/${nombreImagen}`;
    }
});




btnIncrementarCantidad.addEventListener('click', (e)=>{
    inputCantidad.value=parseInt(inputCantidad.value)+1;
});

btnDisminuirCantidad.addEventListener('click', (e)=>{
    if(parseInt(inputCantidad.value)>1){
        inputCantidad.value=parseInt(inputCantidad.value)-1;
    }
    
});