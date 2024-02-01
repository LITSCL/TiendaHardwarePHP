<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hacer Pedido</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<div class="contenido">
	
	<?php
	if (isset($_SESSION["usuario"]) && $_SESSION["usuario"]->tipo == "Cliente"):
	?>
		<div class="contenedor-formulario">
			<h1>Hacer Pedido</h1>
			<form action="<?=BASE_URL?>controllers/PedidoControlador.php" method="POST">
				<label for="ciudad">Ciudad</label>
				<input type="text" name="ciudad" required/>
				<label for="comuna">Comuna</label>
				<input type="text" name="comuna" required/>
				<label for="calle">Calle</label>
				<input type="text" name="calle" required/>
				<button type="submit" name="opcion" value="1">Hacer Pedido</button>
			</form>
		</div>
	<?php 
	else:
	?>
		<div class="contenedor-pagina-centrada">
			<h1 class="titulo-pagina-centrada">Por favor inicia sesión con tu cuenta de usuario para poder realizar la compra</h1>
		</div>
	<?php 
	endif;
	?>
		
	</div>
</body>
</html>