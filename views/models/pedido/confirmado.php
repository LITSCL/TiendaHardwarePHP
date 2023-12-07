<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Pedido Confirmado</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<div class="contenido">
		
		<div id="contenedorPedidoConfirmado" class="contenedor-pagina-centrada">
			<h1 class="titulo-pagina-centrada">Resultado del pedido</h1>
		<?php 
		if (isset($_SESSION["crear_pedido"]) && $_SESSION["crear_pedido"] == "Exitoso"): 
		?>
			<strong class="alerta alerta-verde">Pedido realizado exitosamente</strong>
			<p>
				Una vez que recibamos tu pago en la cuenta bancaria <strong>56283715001</strong>, el pedido será procesado y despachado a tu domicilio.
			</p>
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
		elseif (isset($_SESSION["crear_pedido"]) && $_SESSION["crear_pedido"] == "Fallido"): 
		?>
			<strong class="alerta alerta-roja">Error al realizar el pedido</strong>
			<p>
				Por favor, intenta realizar el pedido mas tarde.
			</p>
		<?php 
		endif;
		?>
		</div>	
		
	</div>
	<?php Helper::borrarSesion("crear_pedido"); ?>
</body>
</html>