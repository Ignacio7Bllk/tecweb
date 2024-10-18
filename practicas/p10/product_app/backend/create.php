<?php
// Conexión a la base de datos
$conexion = @mysqli_connect(
    'localhost',
    'root',
    'b3llak0',
    'marketzone'
);

if (!$conexion) {
    die(json_encode(['status' => 'error', 'message' => '¡Base de datos NO conectada!']));
}

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');

if (!empty($producto)) {
    // SE TRANSFORMA EL STRING DEL JSON A OBJETO
    $jsonOBJ = json_decode($producto);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['status' => 'error', 'message' => 'Error al procesar el JSON.']);
        exit; 
    }

    // VALIDAR SI EL PRODUCTO YA EXISTE
    $stmt = $conexion->prepare("SELECT COUNT(*) FROM productos WHERE nombre = ? AND marca = ? AND modelo = ? AND eliminado = 0");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Error en la consulta: ' . $conexion->error]);
        exit; // Detener la ejecución si hay un error
    }

    // Bind de los parámetros
    $stmt->bind_param("sss", $jsonOBJ->nombre, $jsonOBJ->marca, $jsonOBJ->modelo);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // Si el producto ya existe con la misma marca y modelo
        echo json_encode(['status' => 'error', 'message' => 'El producto ya existe con esta marca y modelo.']);
    } else {
        // INSERTAR EL NUEVO PRODUCTO
        $stmt = $conexion->prepare("INSERT INTO productos (nombre, precio, unidades, modelo, marca, detalles, imagen, eliminado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            echo json_encode(['status' => 'error', 'message' => 'Error en la consulta: ' . $conexion->error]);
            exit; // Detener la ejecución si hay un error
        }

        $eliminado = 0; // Por defecto, el producto no está eliminado
        $stmt->bind_param("sdissssb", $jsonOBJ->nombre, $jsonOBJ->precio, $jsonOBJ->unidades, $jsonOBJ->modelo, $jsonOBJ->marca, $jsonOBJ->detalles, $jsonOBJ->imagen, $eliminado);

        if ($stmt->execute()) {
            // Si la inserción fue exitosa
            echo json_encode(['status' => 'success', 'message' => 'Producto insertado correctamente.']);
        } else {
            // Si hubo un error al insertar
            echo json_encode(['status' => 'error', 'message' => 'Error al insertar el producto: ' . $stmt->error]);
        }

        $stmt->close();
    }

    $conexion->close(); // Cerrar la conexión a la base de datos
} else {
    // Si no se recibe ningún producto
    echo json_encode(['status' => 'error', 'message' => 'No se recibió información del producto.']);
}


?>