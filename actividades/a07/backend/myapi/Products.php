<?php
   namespace TECWEB\MYAPI;

   use TECWEB\MYAPI\DataBase;
   require_once __DIR__.'/database.php';
   
   class Products extends DataBase {
       private $response;
   
       public function __construct($db, $user='root', $pass='b3llak0') {
           $this->response = array();
           parent::__construct($db, $user, $pass);
       }

       public function add($JsonObj, $nom) {
            $this->response = array(
                'status' => 'error',
                'message' => 'Ocurrió un error inesperado.'
            );
            $nombre = $nom;
                
            $this->connection->set_charset("utf8");
            $sql = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND eliminado = 0";
            $result = $this->connection->query($sql);
    
            if ($result->num_rows == 0) {
                $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
                        VALUES ('{$nombre}', '{$JsonObj->marca}', '{$JsonObj->modelo}', {$JsonObj->precio}, '{$JsonObj->detalles}', {$JsonObj->unidades}, '{$JsonObj->imagen}', 0)";
    
                if ($this->connection->query($sql)) {
                    $this->response['status'] = "success";
                    $this->response['message'] = "Producto agregado correctamente";
                } else {
                    $this->response['message'] = "No se ejecutó el SQL. " . $this->connection->error;
                }
            } else {
                $this->response['message'] = "Ya existe un producto con el mismo nombre.";
            }
            $result->free();
    
        $this->connection->close();
        
        }
        public function edit($JsonObj, $nom){
            if (!isset($JsonObj->id)) {
                $this->response['message'] = "Falta el ID del producto";
                return;
            }
            $this->response = array(
                'status' => 'error',
                'message' => 'No se pudo actualizar el producto'
            );
            $nombre = $nom;
            $id = $JsonObj->id;
            $this->connection->set_charset("utf8");
            if (!empty($nombre)) {
                $sql = "UPDATE productos SET nombre = '{$nombre}', marca = '{$JsonObj->marca}', modelo = '{$JsonObj->modelo}', precio = {$JsonObj->precio}, 
                detalles = '{$JsonObj->detalles}', unidades = {$JsonObj->unidades}, imagen = '{$JsonObj->imagen}' WHERE id = {$id}"; 
                $result = $this->connection->query($sql);
                if ($this->connection->query($sql) === TRUE) {
                    $this->response['status'] = "success";
                    $this->response['message'] = "Producto actualizada correctamente";
                }
            }
        }

        public function list() {
            $query = "SELECT * FROM productos WHERE eliminado = 0";
            $result = $this->connection->query($query);
        
            if (!$result) {
                $this->response = ['error' => 'Query Failed', 'message' => $this->connection->error];
                return;
            }
            
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre'],
                    'precio' => $row['precio'],
                    'unidades' => $row['unidades'],
                    'marca' => $row['marca'],
                    'modelo' => $row['modelo'],
                    'detalles' => $row['detalles']
                );
            }
            
            $this->response = $data; 
        }
        public function search($sear){
            $search = $sear;
            $query = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
            $result = $this->connection->query($query); 
            
            if (!$result) {
                die('Query Failed: ' . $this->connection->error);
            }
            
            $json = array();
            while ($row = $result->fetch_assoc()) { 
                $json[] = array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre'],
                    'precio' => $row['precio'],
                    'unidades' => $row['unidades'],
                    'marca' => $row['marca'],
                    'modelo' => $row['modelo'],
                    'detalles' => $row['detalles']
                );
            }
            
            $this->response = $json; 
        }
    
        public function delete($Id){
            $this->response = array(
                'status' => 'error',
                'message' => 'La consulta falló'
            );
            $id = $Id;
            $query = "UPDATE productos SET eliminado = 1 WHERE id = {$id}";
            $result = mysqli_query($this->connection, $query);
        
            if($result){
                $this->response['status'] = "success";
                $this->response['message'] = "Producto eliminado";
            } else {
                $this->response['message'] = "ERROR: No se ejecutó la consulta. " . mysqli_error($this->connection);
            }
        }
        public function single($Id){
            $id= $Id;
            $query = "SELECT * FROM productos WHERE id=$id";
            $result= mysqli_query($this->connection,$query);
            if(!$result){
                die('Query Failed');
            }
            $row = mysqli_fetch_array($result);
            $this->response = array(
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'marca' => $row['marca'],
                'modelo' => $row['modelo'],
                'precio' => $row['precio'],
                'detalles' => $row['detalles'],
                'unidades' => $row['unidades'],
                'imagen' => $row['imagen']
            );

        }
        public function singleByName($nom) {
            $nombre = $nom;
            $query = "SELECT * FROM productos WHERE nombre = '{$nombre}'"; 
            $result = mysqli_query($this->connection, $query);
        
            if (!$result) {
                die('Query Failed');
            }
        
            $row = mysqli_fetch_array($result);
            if ($row) {
                $this->response = array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre'],
                    'marca' => $row['marca'],
                    'modelo' => $row['modelo'],
                    'precio' => $row['precio'],
                    'detalles' => $row['detalles'],
                    'unidades' => $row['unidades'],
                    'imagen' => $row['imagen']
                );
            } else {
                $this->response = ['error' => 'Producto no encontrado'];
            }
        }
        

        public function getResponse() {
            header('Content-Type: application/json');
            echo json_encode($this->response);
            exit;
        }
    }
?>