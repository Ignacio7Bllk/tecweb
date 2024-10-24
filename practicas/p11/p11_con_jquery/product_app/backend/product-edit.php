<?php
header('Content-Type: application/json');

// Conexión a la base de datos
include('db_connection.php');

// Leer datos enviados por el cliente
$data = json_decode(file_get_contents("php://input"), true);

// Validar datos
if (isset($data['id']) && isset($data['nombre']) && isset($data['precio']) && isset($data['unidades']) && isset($data['modelo']) && isset($data['marca']) && isset($data['detalles'])) {
    
    $id = $data['id'];
    $nombre = $data['nombre'];
    $precio = $data['precio'];
    $unidades = $data['unidades'];
    $modelo = $data['modelo'];
    $marca = $data['marca'];
    $detalles = $data['detalles'];

    // Actualizar producto en la base de datos
    $query = "UPDATE productos SET nombre = '$nombre', precio = '$precio', unidades = '$unidades', modelo = '$modelo', marca = '$marca', detalles = '$detalles' WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo json_encode(['status' => 'success', 'message' => 'Producto actualizado correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar el producto']);
    }

} else {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
}

// Cerrar conexión
mysqli_close($conn);
?>
