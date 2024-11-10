
  function init(){

  }
//Iniciación con JQuery
$(document).ready(function(){
    let edit = false;
    console.log('Jquery is working');
    $('#product-result').hide();
    mostrarlista();

    //Verificar si el nombre existe
    $('#nombre').on('input', function () {
        let nombre = $(this).val();
        if (nombre.length > 0) {
            $.ajax({
                url: 'backend/product-check-name.php',
                type: 'POST',
                data: { nombre: nombre },
                success: function (response) {
                    const statusBar = $('#nombreStatus'); 
                    statusBar.removeClass('d-none red green yellow');
                    if (response === 'existe') {
                        $('#nombre').next('small').remove();
                        $('#nombre').after('<small style="color: white;">El nombre del producto ya existe.</small>');
                        statusBar.addClass('red');
                    } else {
                        $('#nombre').next('small').remove();
                        $('#nombre').after('<small style="color: white;">El nombre del producto esta disponible.</small>');
                        statusBar.addClass('green');
                    }
                }
            });
        } else {
            $('#nombre').next('small').remove();
        }
    });

    //Validaciones
    $('#nombre').on('input blur', function() {
        const nombre = $(this).val();
        const statusBar = $('#nombreStatus'); 
        statusBar.removeClass('d-none red green yellow');
        $('#nombre').next('small').remove();
        if (nombre === '') {
            $('#nombre').after('<small style="color: white;">¡Debes llenar el campo nombre!</small>');
            statusBar.addClass('red'); 
        } else if(nombre.length >= 100){
            $('#nombre').after('<small style="color: white;">¡El nombre supera los 100 caracteres!</small>');
            statusBar.addClass('yellow'); 
        }else {
            statusBar.addClass('green');
            console.log("Estado: green");
        }
    });
    $('#marca').on('input blur', function() {
        const marca = $(this).val();
        const statusBar = $('#marcaStatus'); 
        statusBar.removeClass('d-none red green yellow');
        $('#marca').next('small').remove();
        if(marca === 'Marca del producto'){
            statusBar.addClass('red'); 
            $('#marca').after('<small style="color: white;">¡Debes seleccionar una marca!</small>');
        }else{
            statusBar.addClass('green');
        }
    });
    $('#modelo').on('input blur', function() {
        const modelo = $(this).val();
        const statusBar = $('#modeloStatus'); 
        statusBar.removeClass('d-none red green yellow');
        $('#modelo').next('small').remove();
        if (modelo === '') {
            statusBar.addClass('red'); 
            $('#modelo').after('<small style="color: white;">¡Debes llenar el campo modelo!</small>');
        }else if(modelo.length >= 25){
            $('#modelo').after('<small style="color: white;">¡El modelo supera los 25 caracteres!</small>');
            statusBar.addClass('yellow'); 
        } else {
            statusBar.addClass('green');
        }
    });
    $('#precio').on('input blur', function(){
        const precio = parseFloat($(this).val());
        const statusBar = $('#precioStatus'); 
        statusBar.removeClass('d-none red green yellow');
        $('#precio').next('small').remove();
        if(isNaN(precio)){
            statusBar.addClass('red'); 
            $('#precio').after('<small style="color: white;">¡Debes llenar el campo precio!</small>');
        }else if (precio <= 99.99) {
            statusBar.addClass('yellow'); 
            $('#precio').after('<small style="color: white;">¡El precio debe ser mayor a 99.99!</small>');
        }else{
            statusBar.addClass('green');
        }
    });
    $('#detalles').on('input blur', function(){
        const detalles = $(this).val();
        const statusBar = $('#detallesStatus'); 
        statusBar.removeClass('d-none red green yellow');
        $('#detalles').next('small').remove();
        if(detalles === ''){
            statusBar.addClass('red'); 
            $('#detalles').after('<small style="color: white;">¡Debes llenar el campo detalles!</small>');
        }else if(detalles.length >=250){
            statusBar.addClass('yellow'); 
            $('#detalles').after('<small style="color: white;">¡El campo detalles tiene más de 250 caracteres!>');
        }else{
            statusBar.addClass('green');
        }
    });
    $('#unidades').on('input blur', function(){
        const unidades = parseInt($(this).val());
        const statusBar = $('#unidadesStatus'); 
        statusBar.removeClass('d-none red green yellow');
        $('#unidades').next('small').remove();
        if(isNaN(unidades)){
            statusBar.addClass('red'); 
            $('#unidades').after('<small style="color: white;">¡Debes llenar el campo unidades!</small>');
        }else if (unidades===0) {
            statusBar.addClass('yellow'); 
            $('#unidades').after('<small style="color: white;">¡El campo unidades debe ser mayor a 0!</small>');
        }else{
            statusBar.addClass('green');
        }
    });
    $('#imagen').on('input blur', function(){
        const imagen = $(this).val();
        const statusBar = $('#imagenStatus'); 
        statusBar.removeClass('d-none red green yellow');
        $('#imagen').next('small').remove();
        if(imagen === ''){
            statusBar.addClass('red'); 
            $('#imagen').after('<small style="color: white;">¡Debes llenar el campo ruta de imagen!</small>');
        }else{
            statusBar.addClass('green');
        }
    });


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
                    let productos = JSON.parse(response);
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
        var nombre = $('#nombre').val();
        var modelo = $('#modelo').val();
        var precio = parseFloat($('#precio').val());
        var detalles = $('#detalles').val();
        var unidades = parseInt($('#unidades').val());
        var imagen = $('#imagen').val();

        if (nombre === '' || modelo === '' || isNaN(precio) || precio <= 0 || detalles === '' || isNaN(unidades) || unidades <= 0) {
            alert('¡Debes llenar todos los campos del formulario!');
            e.preventDefault();
            return;
        }

        //Enviar datos
        const postData ={
            nombre: $('#nombre').val(),
            marca: $('#marca').val(),
            modelo: $('#modelo').val(),
            precio: $('#precio').val(),
            detalles: $('#detalles').val(),
            unidades: $('#unidades').val(),
            imagen: imagen,
            producto_id: $('#producto_id').val()
        };

        let Url = edit === false ? 'backend/product-add.php' : 'backend/product-edit.php';
        console.log(Url);
        console.log(postData);

        $.post(Url,postData, function(response){
            $('#container').html(response);
            $('#product-result').removeClass('d-none');
            mostrarlista();
            $('#product-form').trigger('reset');
        })
        e.preventDefault();
    })

    //Mostrar lista
    function mostrarlista(){
        $.ajax({
            url:'backend/product-list.php',
            type: 'GET',
            success: function(response){
                let productos = JSON.parse(response);
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
                $('#container').html(response);
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
            const producto = JSON.parse(response);
            $('#producto_id').val(producto.id);
            $('#nombre').val(producto.nombre);
            $('#marca').val(producto.marca);
            $('#modelo').val(producto.modelo);
            $('#precio').val(producto.precio);
            $('#detalles').val(producto.detalles);
            $('#unidades').val(producto.unidades);
            $('#imagen').val(producto.imagen);
            delete producto.id;
            delete producto.nombre;
            delete producto.marca;
            delete producto.modelo;
            delete producto.precio;
            delete producto.detalles;
            delete producto.unidades;
            delete producto.imagen;
            edit = true;
        });
    });

});