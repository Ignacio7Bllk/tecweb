// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

// Inicialización para cargar el JSON base
function init() {
    var JsonString = JSON.stringify(baseJSON, null, 2);
    $("#description").val(JsonString);

    // Cargar lista de productos al iniciar la página
    listarProductos();
}

// Cargar la lista de productos NO eliminados
function listarProductos() {
    $.ajax({
        url: './backend/product-list.php',
        method: 'GET',
        contentType: 'application/x-www-form-urlencoded',
        success: function(response) {
            let productos = JSON.parse(response);
            if (Object.keys(productos).length > 0) {
                let template = '';
                productos.forEach(producto => {
                    let descripcion = `
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                    `;
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>
                            
                                <a href="#" class="product-item">
                                    ${producto.nombre}                           
                                </a>
                            </td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
                });
                $("#products").html(template);
            }
        }
    });
}

// Buscar productos mientras se escribe en el campo de búsqueda
$('#search').on('keyup', function() {
    let search = $(this).val();
    $.ajax({
        url: './backend/product-search.php',
        method: 'GET',
        data: { search: search },
        success: function(response) {
            let productos = JSON.parse(response);
            let template = '';
            let template_bar = '';
            if (Object.keys(productos).length > 0) {
                productos.forEach(producto => {
                    let descripcion = `
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                    `;
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                    template_bar += `<li>${producto.nombre}</li>`;
                });
                $("#product-result").addClass("d-block");
                $("#container").html(template_bar);
                $("#products").html(template);
            } else {
                $("#product-result").removeClass("d-block");
                $("#container").html('');
                $("#products").html('');
            }
        }
    });
});

// Agregar un producto nuevo y actualizar la lista
$('#product-form').on('submit', function(e) {
    e.preventDefault();
    
    // Obtener el JSON del textarea
    let productoJsonString = $('#description').val();
    let finalJSON = JSON.parse(productoJsonString);
    
    // Obtener el nombre del producto desde el input correspondiente
    let nombre = $('#name').val();

    // Validaciones
    if (nombre.length > 100) {
        alert('¡El campo nombre tiene más de 100 caracteres!');
        return; 
    }
    if (nombre.trim() === '' ) {
        alert('¡El campo nombre no puede estar vacío!');
        return; 
    }
   
    if (finalJSON.modelo.length > 25) {
        alert('¡El campo modelo tiene más de 25 caracteres!');
        return; 
        
    }

    if (finalJSON.precio <= 99.99) {
        alert('¡El precio debe ser mayor a 99.99!');
        return; 
    }
    if (finalJSON.detalles.length > 250) {
        alert('¡El campo detalles tiene más de 250 caracteres!');
        return; 
    }
    if (isNaN(finalJSON.unidades) || finalJSON.unidades < 0) {
        alert('¡El campo unidades debe ser un número mayor a 0!');
        return; 
    }

    // Añadir el nombre al objeto JSON
    finalJSON['nombre'] = nombre;
    productoJsonString = JSON.stringify(finalJSON, null, 2);

    // Realizar la solicitud AJAX para agregar el producto
    $.ajax({
        url: './backend/product-add.php',
        method: 'POST',
        contentType: "application/json;charset=UTF-8",
        data: productoJsonString,
        success: function(response) {
            let respuesta = JSON.parse(response);
            let template_bar = `
                <li style="list-style: none;">status: ${respuesta.status}</li>
                <li style="list-style: none;">message: ${respuesta.message}</li>
            `;
            $("#product-result").addClass("d-block");
            $("#container").html(template_bar);
            listarProductos(); // Actualiza la lista
        }
    });
});


// Eliminar un producto y actualizar la lista
$(document).on('click', '.product-delete', function() {
    if (confirm("De verdad deseas eliminar el Producto")) {
        let id = $(this).closest('tr').attr("productId");

        $.ajax({
            url: './backend/product-delete.php',
            method: 'GET',
            data: { id: id },
            success: function(response) {
                let respuesta = JSON.parse(response);
                let template_bar = `
                    <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message}</li>
                `;
                $("#product-result").addClass("d-block");
                $("#container").html(template_bar);
                listarProductos(); // Actualiza la lista
            }
        });
    }
});

$(document).on('click', '.product-item', function() {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('productid');
    $.post('backend/product-single.php', { id }, function(response) {
        const producto = JSON.parse(response);
        $('#producto_id').val(producto.id);
        $('#name').val(producto.nombre);
        delete producto.id;
        delete producto.nombre;
        $('#description').val(JSON.stringify(producto, null, 2));
        edit = true;
    });
});





// Ejecutar la función init() al cargar la página
//$(document).ready(init);

