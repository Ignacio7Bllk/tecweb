<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<?php



if (isset($_GET['tope'])) 
	$tope= $_GET['tope'];
	
	if (!empty($tope)) {
		@$link=new mysqli('localhost', 'root', 'b3llak0', 'marketzone');

		if ($link->connect_errno){
			die('fallo la conexion: '.$link->connect_error.'<br/>');
		}    

		if ($result=$link->query("SELECT * FROM productos WHERE id<='{$tope}'")) {
			
			$rows =$result->fetch_all(MYSQLI_ASSOC);
			$result->free();

		}
		$link->close();
	}
	

?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Producto</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
		<h3>PRODUCTO</h3>

		<br/>
		
		<?php if( isset($rows) && count($rows) > 0 ) : ?>

			<table class="table">
				<thead class="thead-dark">
					<tr>
					<th scope="col">#</th>
					<th scope="col">Nombre</th>
					<th scope="col">Marca</th>
					<th scope="col">Modelo</th>
					<th scope="col">Precio</th>
					<th scope="col">Unidades</th>
					<th scope="col">Detalles</th>
					<th scope="col">Imagen</th>
                    <th scope="col">modificar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($rows as $row): ?>
					<tr>
						<th scope="row"><?= $row['id'] ?></th>
						<td><?= $row['nombre'] ?></td>
						<td><?= $row['marca'] ?></td>
						<td><?= $row['modelo'] ?></td>
						<td><?= $row['precio'] ?></td>
						<td><?= $row['unidades'] ?></td>
						<td><?= utf8_encode($row['detalles']) ?></td>
						<td><img src="<?= $row['imagen'] ?>" style="width: 200px; height: auto;"></td>
                        <td><a href="http://localhost:8089/Desktop/tecweb/practicas/p09/formulario_productos_v2.php?id=<?= $row['id'] ?>">modificar</a></td>

                        

					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

		<?php elseif(!empty($tope)) : ?>

			<script>
				alert('El ID del producto no existe');
			</script>

		<?php endif; ?>
	</body>

</html>