// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

//FUNCION VALIDAR DATOS

function validarProducto(e){

    var productoJsonString = document.getElementById('description').value;
    var finalJSON = JSON.parse(productoJsonString);
    finalJSON['nombre'] = document.getElementById('name').value;

    // Validaciones
    if (finalJSON.nombre === '' ) {
        alert('¡Debes llenar el campo Nombre!');
        event.preventDefault();
        return;
    } else if (finalJSON.marca === '') {
        alert('¡Debes llenar el campo Marca!');
        event.preventDefault();
        return;
    } else if (finalJSON.modelo === '') {
        alert('¡Debes llenar el campo Modelo!');
        event.preventDefault();
        return;
    } else if (isNaN(finalJSON.precio)) {
        alert('¡Debes llenar el campo Precio correctamente!');
        event.preventDefault();
        return;
    }
    // Validaciones adicionales
    if (finalJSON.nombre.length > 100) {
        alert('¡El campo nombre tiene más de 100 caracteres!');
        event.preventDefault();
        return;
    }
    if (finalJSON.modelo.length > 25) {
        alert('¡El campo modelo tiene más de 25 caracteres!');
        event.preventDefault();
        return;
    }
    if (finalJSON.precio <= 99.99) {
        alert('¡El precio debe ser mayor a 99.99!');
        event.preventDefault();
        return;
    }
    if (finalJSON.detalles.length > 250) {
        alert('¡El campo detalles tiene más de 250 caracteres!');
        event.preventDefault();
        return;
    }
    if (isNaN(finalJSON.unidades) || finalJSON.unidades < 0) {
        alert('¡El campo unidades debe ser un número mayor o igual a 0!');
        event.preventDefault();
        return;
    }
    if (finalJSON.imagen === '') {
        finalJSON.imagen = 'img/imagen_predefinida.png';
    }

    agregarProducto(event);

}


function agregarProducto(e){
    e.preventDefault();

    var productoJsonString = document.getElementById('description').value;
    var finalJSON = JSON.parse(productoJsonString);
    finalJSON['nombre'] = document.getElementById('name').value;
    productoJsonString = JSON.stringify(finalJSON);

    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            var response = JSON.parse(client.responseText);
            // Muestra un alert con el mensaje de estado
            window.alert(response.message);
        }
    };
    client.send(productoJsonString);

}

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarID(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    var id = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {

        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            
            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if(Object.keys(productos).length > 0) {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let descripcion = '';
                    descripcion += '<li>precio: '+productos.precio+'</li>';
                    descripcion += '<li>unidades: '+productos.unidades+'</li>';
                    descripcion += '<li>modelo: '+productos.modelo+'</li>';
                    descripcion += '<li>marca: '+productos.marca+'</li>';
                    descripcion += '<li>detalles: '+productos.detalles+'</li>';
                
                // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                    template += `
                        <tr>
                            <td>${productos.id}</td>
                            <td>${productos.nombre}</td>
                            <td><ul>${precio}</ul></td>
                        </tr>
                    `;

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
        }
    };
    client.send("id="+id);
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}


function buscarProducto(e) {
    e.preventDefault();

    var id = document.getElementById('search').value;
    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    // SE ABRE LA CONEXIÓN
    client.open('POST', './backend/read.php', true);
    // SE CONFIGURA EL ENCABEZADO DE LA PETICIÓN
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // SE ASIGNA LA FUNCIÓN CALLBACK
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n' + client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);
            const contProductos = document.getElementById('productos');
            // SE LIMPIA EL CONTENIDO DEL CONTENEDOR
            contProductos.innerHTML = '';

            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if (Array.isArray(productos) && productos.length > 0) {
                productos.forEach(producto => {
                    let plantilla = `
                    <tr>
                        <td>${producto.id}</td>
                        <td>${producto.nombre}</td>
                        <td>${producto.precio}</td>
                        <td>${producto.unidades}</td>
                        <td>${producto.modelo}</td>
                        <td>${producto.marca}</td>
                        <td>${producto.detalles}</td>
                        <td><img src="${producto.imagen}" alt="Imagen del producto" style="width: 100px; height: auto;"/></td>
                    </tr>
                    `;
                    contProductos.innerHTML += plantilla;
                });
            } else {
                contProductos.innerHTML = "No se encontraron productos";
            }
        }
    };
    // SE ENVÍAN LOS DATOS DE LA BÚSQUEDA
    client.send("search=" + encodeURIComponent(id));

}
