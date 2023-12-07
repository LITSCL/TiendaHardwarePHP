<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Gestionar Pedido</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<div class="contenido">
		
		<div class="contenedor-pagina-centrada">
			<h1 class="titulo-pagina-centrada">Gestionar el pedido</h1>
			<?php 
			if (isset($datosPedido)): 
				$datosPedido = $datosPedido->fetch_object();
			?>
				<br/>
				<h3>Cambiar estado del pedido:</h3>
				<form class="formulario-gestionar-pedido" action="<?=BASE_URL?>controllers/PedidoControlador.php" method="POST">
					<input type="hidden" name="id" value="<?=$datosPedido->id?>"/>
					<select name="estado">
						<option value="Confirmado" <?=$datosPedido->estado == "Confirmado" ? "selected" : "";?>>Confirmado</option>
						<option value="En preparación" <?=$datosPedido->estado == "En preparación" ? "selected" : "";?>>En preparación</option>
						<option value="Preparado para enviar" <?=$datosPedido->estado == "Preparado para enviar" ? "selected" : "";?>>Preparado para enviar</option>
						<option value="Enviado" <?=$datosPedido->estado == "Enviado" ? "selected" : "";?>>Enviado</option>
					</select>
					<button type="submit" name="opcion" value="2">Cambiar</button>
				</form>
				<br/>
				<h3>Datos del pedido:</h3>
				<div class="contenedor-datos-pedido">
					Numero de pedido: <?php print_r($datosPedido->id); ?>
					<br/>
					Total a pagar: $<?php print_r(number_format($datosPedido->coste, 0, ",", ".")); ?>
					<br/>
					Estado del pedido: <?=$datosPedido->estado?>
					<br/>
					Productos:
					<table class="tabla">
						<tr>
							<th>Imagen</th>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Unidades</th>
						</tr>
					<?php 
					while ($producto = $productosPedido->fetch_object()):
					?>
						<tr>
							<td>
								<img class="imagen-carrito" src="<?=BASE_URL . 'uploads/models/producto/images/' . $producto->imagen?>"/>
							</td>
							<td>
								<?=$producto->nombre?>
							</td>
							<td>
								$<?=number_format($producto->precio, 0, ",", ".")?>
							</td>
							<td>
								<?=$producto->unidades?>
							</td>
						</tr>
					<?php 
					endwhile;
					?>
					</table>
				</div>	
			<?php 
			endif; 
			?>
		</div>	
		
	</div>
</body>
</html>