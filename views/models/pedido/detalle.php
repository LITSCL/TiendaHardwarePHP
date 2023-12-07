<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Detalle Pedido</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<div class="contenido">
		
		<div class="contenedor-pagina-centrada">
		<?php 
		if (isset($_SESSION["error_detalle_pedido"]) && $_SESSION["error_detalle_pedido"] == "El pedido no te pertenece"):
		?>
			<h1 class="titulo-pagina-centrada">El pedido que buscas no te pertenece</h1>
		<?php 
		elseif (isset($_SESSION["error_detalle_pedido"]) && $_SESSION["error_detalle_pedido"] == "El pedido no existe"):
		?>
			<h1 class="titulo-pagina-centrada">El pedido que buscas no existe</h1>
		<?php 
		else:
		?>
			<h1 class="titulo-pagina-centrada">Detalle del pedido</h1>
			<?php 
			if (isset($datosPedido)): 
				$datosPedido = $datosPedido->fetch_object();
			?>
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
		<?php 
		endif;
		?>	
		</div>	
	</div>
	<?php Helper::borrarSesion("error_detalle_pedido"); ?>
</body>
</html>