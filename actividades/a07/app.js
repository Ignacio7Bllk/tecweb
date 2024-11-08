// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
    //listarProductos();
}

//Iniciación con JQuery
$(document).ready(function(){
    let edit = false;
    console.log('Jquery is working');
    $('#product-result').hide();
    mostrarlista();

    //Busquedad de Producto
    $('#search').keyup(function(e){
        if($('#search').val()){
            
            let search = $('#search').val();
            console.log(search);
            $.ajax({
                url: 'backend/product-search.php', 
                type: 'POST',
                data: { search },
                success: function(response){
                    console.log(response);
                    let productos = response;
                    let template = '';
                    productos.forEach(producto => {
                        template += `
                        <li> ${producto.nombre}</li>
                        `;
                        console.log(producto.nombre);
                    });
                    $('#container').html(template);
                    $('#product-result').removeClass('d-none');
                }
            });
        }
    })

    //Agregar Producto
    $('#product-form').submit(function(e){
        //Validar datos
        var nombre = $('#name').val();
        var descripcion = $('#description').val();
        var objectJSON = JSON.parse(descripcion);

        if (nombre.length > 100) {
            alert('¡El campo nombre tiene más de 100 caracteres!');
            e.preventDefault();
            return;
        }
        if (objectJSON.modelo.length > 25) {
            alert('¡El campo modelo tiene más de 25 caracteres!');
            e.preventDefault();
            return;
        }
        if (objectJSON.precio <= 99.99) {
            alert('¡El precio debe ser mayor a 99.99!');
            e.preventDefault();
            return;
        }
        if (objectJSON.detalles.length > 250) {
            alert('¡El campo detalles tiene más de 250 caracteres!');
            e.preventDefault();
            return;
        }
        if (isNaN(objectJSON.unidades) || objectJSON.unidades < 0) {
            alert('¡El campo unidades debe ser un número mayor o igual a 0!');
            e.preventDefault();
            return;
        }
        //Enviar datos
        const postData ={
            name: $('#name').val(),
            description: $('#description').val(),
            producto_id: $('#producto_id').val()
        };

        let Url = edit === false ? 'backend/product-add.php' : 'backend/product-edit.php';
        console.log(Url);

        $.post(Url,postData, function(response){
            console.log(response);
            var formattedMessage = "status: " + response.status + "<br>message: " + response.message;
            $('#container').html(formattedMessage);
            $('#product-result').removeClass('d-none');
            mostrarlista();
            $('#product-form').trigger('reset');
            init();
        })
        e.preventDefault();
    })

    //Mostrar lista
    function mostrarlista(){
        $.ajax({
            url:'backend/product-list.php',
            type: 'GET',
            success: function(response){
                console.log("Respuesta del servidor:", response);
                let productos = response;
                let template = '';
                productos.forEach(producto => {
                    template += `
                        <tr productoID="${producto.id}">
                            <td>${producto.id}</td>
                            <td>
                                <a href="#" class="product-item">${producto.nombre}</a>
                            </td>
                            <td>
                                <ul>
                                    <li>precio: ${producto.precio}</li>
                                    <li>unidades: ${producto.unidades}</li>
                                    <li>modelo: ${producto.modelo}</li>
                                    <li>marca: ${producto.marca}</li>
                                    <li>detalles: ${producto.detalles}</li>
                                </ul>
                            </td>
                            <td>
                                <button class="product-delete btn btn-danger"">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
                });
                $('#products').html(template);
                $('#product-result').show();
            }
        })
    }
    
    //Eliminar producto
    $(document).on('click', '.product-delete', function(){
        if(confirm("De verdad deseas eliminar el Producto")){
            let element = $(this)[0].parentElement.parentElement;
            let id= $(element).attr('productoID');
            $.post('backend/product-delete.php', {id}, function(response){
                console.log(response);
                var formattedMessage = "status: " + response.status + "<br>message: " + response.message;
                $('#container').html(formattedMessage);
                $('#product-result').removeClass('d-none');
                mostrarlista(); 
            })
        }
    });

    
    //Iteraccion con el usuario
    $(document).on('click', '.product-item', function() {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productoID');
        $.post('backend/product-single.php', { id }, function(response) {
            console.log(response);
            const producto = response;
            $('#producto_id').val(producto.id);
            $('#name').val(producto.nombre);
            delete producto.id;
            delete producto.nombre;
            $('#description').val(JSON.stringify(producto, null, 2));
            edit = true;
        });
    });

});