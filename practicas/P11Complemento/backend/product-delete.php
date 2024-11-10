<?php
    include("database.php");
    $data = array(
        'status'  => 'error',
        'message' => 'La consulta falló'
    );
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $query = "UPDATE productos SET eliminado = 1 WHERE id = {$id}";
        $result = mysqli_query($conexion, $query);
        
        if($result){
            $data['status'] = "success";
            $data['message'] = "Producto eliminado";
        } else {
            $data['message'] = "ERROR: No se ejecutó la consulta. " . mysqli_error($conexion);
        }
        echo 'status: '.$data['status'].'<br> message: '.$data['message'];
    }
?>
