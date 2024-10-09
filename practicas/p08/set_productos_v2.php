<?php
$nombre = $_POST['nombre'];
$marca  = $_POST['marca'];
$modelo = $_POST['modelo'];
$precio = $_POST['precio'];
$detalles = $_POST['detalles'];
$unidades = $_POST['unidades'];
$imagen   = $_POST['imagen'];

// Definir los límites de caracteres para cada campo

// Verificar la longitud de cada campo
if (strlen($nombre) > 100 || strlen($marca) > 25 || strlen($modelo) > 25 || strlen($detalles) > 250 || strlen($imagen) > 100) {
	if (strlen($nombre) > 100) {
		echo "El campo 'nombre' excede el número máximo de caracteres permitido.<br/>";
	}
	if (strlen($marca) > 25) {
		echo "El campo 'marca' excede el número máximo de caracteres permitido.<br/>";
	}
	if (strlen($modelo) > 25) {
		echo "El campo 'modelo' excede el número máximo de caracteres permitido.<br/>";
	}
	if (strlen($detalles) > 250) {
		echo "El campo 'detalles' excede el número máximo de caracteres permitido.<br/>";
	}
	if (strlen($imagen) > 100) {
		echo "El campo 'imagen' excede el número máximo de caracteres permitido.<br/>";
	}
	exit();
}

if (!filter_var($precio, FILTER_VALIDATE_INT) || !filter_var($unidades, FILTER_VALIDATE_INT)) {
	if (!filter_var($precio, FILTER_VALIDATE_INT)) {
		echo "El campo 'precio' debe ser un número entero.<br/>";
	}
	if (!filter_var($unidades, FILTER_VALIDATE_INT)) {
		echo "El campo 'unidades' debe ser un número entero.<br/>";
	}
	exit();
}

// SE CREA EL OBJETO DE CONEXION
@$link = new mysqli('localhost', 'root', 'b3llak0', 'marketzone');

// comprobar la conexión
if ($link->connect_errno) {
	die('Falló la conexión: ' . $link->connect_error . '<br/>');
}

// SE CREA LA CONSULTA SQL PARA VERIFICAR COINCIDENCIAS
$sql = "SELECT * FROM productos WHERE nombre = '$nombre' AND marca = '$marca' AND modelo = '$modelo'";
$result = $link->query($sql);

if ($result->num_rows > 0) {
	// Mostrar HTML solo si la inserción fue exitosa
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
		<head>
			<meta http-equiv="content-type" content="text/html;charset=utf-8" />
			<title>Registro de Producto Incompleto</title>
			<style type="text/css">
				body {
					margin: 20px;
					background-color: #8e0000;
					font-family: Verdana, Helvetica, sans-serif;
					font-size: 90%;
				}
				h1 {
					color: #fafafa;
					border-bottom: 1px solid #fafafa;
				}
				p {
					color: #fafafa;
				}
				h2 {
					font-size: 1.2em;
					color: #fafafa;
				}
			</style>
		</head>
		<body>
			<h1>¡No se puede registrar!</h1>
			<p>No se puede registrar el producto ya que existe en la Base de Datos</p>
			<p>
				<a href="http://validator.w3.org/check?uri=referer"><img
				src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
			</p>
		</body>
	</html>
	<?php
} else {
	// SE CREA LA CONSULTA SQL PARA INSERTAR EL PRODUCTO
	//// $sql = "INSERT INTO productos (id, nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES (NULL, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";


	$sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";
	if ($link->query($sql) === TRUE) {
		// Mostrar HTML solo si la inserción fue exitosa
		?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
			"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
			<head>
				<meta http-equiv="content-type" content="text/html;charset=utf-8" />
				<title>Registro de Producto Completado</title>
				<style type="text/css">
					body {
						margin: 20px;
						background-color: #C4DF9B;
						font-family: Verdana, Helvetica, sans-serif;
						font-size: 90%;
					}
					h1 {
						color: #005825;
						border-bottom: 1px solid #005825;
					}
					h2 {
						font-size: 1.2em;
						color: #4A0048;
					}
				</style>
			</head>
			<body>
				<h1>¡REGISTRO DE PRODUCTO!</h1>
				<p>Hemos recibido la siguiente información sobre tu producto:</p>
				<h2>Detalles del Producto:</h2>
				<ul>
					<li><strong>Nombre:</strong> <em><?php echo $nombre; ?></em></li>
					<li><strong>Marca:</strong> <em><?php echo $marca; ?></em></li>
					<li><strong>Modelo:</strong> <em><?php echo $modelo; ?></em></li>
					<li><strong>Precio:</strong> <em><?php echo $precio; ?></em></li>
				</ul>
				<p><strong>Descripción:</strong> <em><?php echo $detalles; ?></em></p>
				<h2>Información adicional:</h2>
				<ul>
					<li><strong>Unidades disponibles:</strong> <em><?php echo $unidades; ?></em></li>
					<li><strong>URL de Imagen:</strong> <em><?php echo $imagen; ?></em></li>
				</ul>
				<p>
					<a href="http://validator.w3.org/check?uri=referer"><img
					src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
				</p>
			</body>
		</html>
		<?php
	} else {
		echo "Error: " . $sql . "<br/>" . $link->error;
	}
}

$link->close();
?>
