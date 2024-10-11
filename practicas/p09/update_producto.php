<?php
/* MySQL Conexion */
$link = mysqli_connect("localhost", "root", "b3llak0", "marketzone");
// Verificar si la conexión fue exitosa
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error . '<br/>');
}

// Recibe datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Comprobar que los campos necesarios están presentes
    if (isset($_POST['nombre'], $_POST['marca'], $_POST['modelo'], $_POST['precio'], $_POST['unidades'], $_POST['detalles'], $_POST['imagen'])) {
        $nombre = $link->real_escape_string($_POST['nombre']);
        $marca = $link->real_escape_string($_POST['marca']);
        $modelo = $link->real_escape_string($_POST['modelo']);
        $precio = $link->real_escape_string($_POST['precio']);
        $unidades = $link->real_escape_string($_POST['unidades']);
        $detalles = $link->real_escape_string($_POST['detalles']);
        $imagen = $link->real_escape_string($_POST['imagen']);
        $id = $link->real_escape_string($_POST['id']); 

        // Ejecuta la actualización del registro
        $sql = "UPDATE productos SET 
                nombre='$nombre', 
                marca='$marca', 
                modelo='$modelo', 
                precio='$precio', 
                unidades='$unidades', 
                detalles='$detalles', 
                imagen='$imagen' 
                WHERE id='$id'";
        
        if (mysqli_query($link, $sql)) {
            echo "Registro actualizado.";
        } else {
            echo "ERROR: No se ejecutó $sql. " . mysqli_error($link);
        }
    } else {
        echo "ERROR: Falta algún campo en el formulario.";
    }
}

// Cierra la conexión
mysqli_close($link);
?>

<p>
    <a href="get_productos_xhtml_v2.php">Ver Productos</a> | 
    <a href="get_productos_vigentes_v2.php">Ver Productos Vigentes</a>
</p>