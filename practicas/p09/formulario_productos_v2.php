<!-- <!DOCTYPE html > -->
<html>

<?php
// Verificar si hay un ID de producto en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conectar a la base de datos
    @$link = new mysqli('localhost', 'root', 'b3llak0', 'marketzone');

    if ($link->connect_errno) {
        die('Error de conexión: ' . $link->connect_error);
    }

    // Consultar la información del producto por ID
    $result = $link->query("SELECT * FROM productos WHERE id = '{$id}'");

    if ($result && $result->num_rows > 0) {
        // Obtener los datos del producto
        $producto = $result->fetch_assoc();
    } else {
        die('Producto no encontrado');
    }

    // Cerrar la conexión
    $link->close();
}
?>


  <head>
    <meta charset="utf-8" >
    <title>Productos</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #343a40;
        }

        p {
            text-align: center;
            color: #6c757d;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
          
        }

        fieldset {
            border: none;
            padding: 0;
        }

        legend {
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1em;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 1em;
            margin-right: 10px;
        }

        input[type="reset"] {
            background-color: #6c757d;
        

        }
    </style>
    
    <script>
  function validarFormulario() {
    var nombre = document.getElementById("form-nombre").value;
    var marca = document.getElementById("form-marca").value;
    var modelo = document.getElementById("form-modelo").value;
    var precio = document.getElementById("form-precio").value;
    var detalles = document.getElementById("form-detalles").value;
    var unidades = document.getElementById("form-unidades").value;
    var imagen = document.getElementById("form-imagen").value;

    /* Validar campos vacíos */
    if (nombre === "" || marca === "" || modelo === "" || precio === "" || detalles === "" || unidades === "") {
      alert("Todos los campos son obligatorios");
      return false;
    }

    /* Validar longitud de los campos */
    if (nombre.length > 100) {
      alert("El campo nombre no puede tener más de 100 caracteres");
      return false;
    }

    if (marca.length > 50) {
      alert("El campo marca no puede tener más de 50 caracteres");
      return false;
    }
    if (modelo.length > 50) {
      alert("El campo modelo no puede tener más de 50 caracteres");
      return false;
    }
    if (detalles.length > 250) {
      alert("El campo detalles no puede tener más de 250 caracteres");
      return false;
    }

    if (imagen.trim() === "") {
      document.getElementById("form-imagen").value = "img.png";
    }

    /* Validar que el precio sea un número y mayor a 99.99 */
    precio = parseFloat(precio);
    if (isNaN(precio) || precio < 99.99) {
      alert("El campo precio debe ser un número mayor o igual a 99.99");
      return false;
    }

    /* Validar que unidades sea un número no negativo */
    unidades = parseInt(unidades);
    if (isNaN(unidades) || unidades < 0) {
      alert("El campo unidades debe ser un número no negativo");
      return false;
    }

    return true;
  }

  window.onload = function() {
    var form = document.getElementById("formularioTenis");
    form.onsubmit = function(event) {
      if (!validarFormulario()) {
        event.preventDefault(); // Evita que se envíe el formulario si la validación falla
      }
    };
  };
</script>


  </head>
  <body>
    <h1>Registro de producto&ldquo;Chidos&rdquo;</h1>
    <p>Por favor rellene los campos</p>
    <form  id="formularioTenis" method="post" action="http://localhost:8089/Desktop/tecweb/practicas/p09/update_producto.php">

      <!--</form> action="http://localhost:8089/Pruebas/p08/P8_1/set_producto_v2.php">-->
    <h2>Producto</h2>
      <fieldset>
        <legend>Información Producto</legend>
        <ul>
        <input type="hidden" name="id" value="<?= !empty($producto['id']) ? htmlspecialchars($producto['id']) : '' ?>">

          <li><label for="form-name">Nombre:</label> <input type="text" name="nombre" id="form-nombre" value="<?= !empty($producto['nombre']) ? htmlspecialchars($producto['nombre']) : '' ?>" ></li>
          <li><label for="form-marca">Marca:</label> <input type="text" name="marca" id="form-marca" value="<?= !empty($producto['marca'])? htmlspecialchars($producto['marca']): ''?>" ></li>
          <li><label for="form-tel">Modelo:</label> <input type="text" name="modelo" id="form-modelo" value="<?= !empty($producto['modelo'])? htmlspecialchars($producto['modelo']): ''?>"></li>
          <li><label for="form-marca">Precio:</label> <input type="text" name="precio" id="form-precio" value="<?= !empty($producto['precio'])? htmlspecialchars($producto['precio']): ''?>"></li>
          <li><label for="form-story">Detalle:</label><br><textarea name="detalles" rows="4" cols="60" id="form-detalles" placeholder="No más de 250 caracteres de longitud"><?= !empty($producto['detalles']) ? htmlspecialchars($producto['detalles']) : '' ?></textarea></li> 
            <li><label for="form-marca">Unidades</label> <input type="text" name="unidades" id="form-unidades" value="<?= !empty($producto['unidades'])? htmlspecialchars($producto['unidades']): ''?>" ></li>
            <li><label for="form-tel">Imagen:</label> <input type="text" name="imagen" id="form-imagen" value="<?= !empty($producto['imagen'])? htmlspecialchars($producto['imagen']): ''?>"></li>
        </ul>
      </fieldset>
      </fieldset>
      <p>
        <input type="submit" value="Registrar producto">
        <input type="reset">
      </p>

    </form>
  </body>
</html>