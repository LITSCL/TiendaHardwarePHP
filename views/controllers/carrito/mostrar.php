<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Mostrar Carrito</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<div class="contenido">
		
		<div id="contenedorMostrarCarrito" class="contenedor-pagina-centrada">
		<?php 
		if (isset($_SESSION["limite_unidades"])):
		?>
			<strong class="alerta alerta-amarilla">Lo sentimos, no tenemos suficientes unidades de ese producto</strong>
		<?php 
		endif;
		?>
		
		<?php 
		if (isset($_SESSION["carrito"]) && count($_SESSION["carrito"]) >= 1):
			$carrito = $_SESSION["carrito"];
		?>
			<table class="tabla">
				<tr>
					<th>Imagen</th>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Unidades</th>
					<th>Acción</th>
				</tr>
			<?php 
			foreach ($carrito as $i => $elemento):
				$producto = $elemento["objeto"];
			?>
				<tr>
					<td>
						<img class="imagen-carrito" src="<?=BASE_URL . 'uploads/models/producto/images/' . $producto->imagen?>"/>
					</td>
					<td>
						<a href="#"><?=$producto->nombre?></a>
					</td>
					<td>
						$<?=number_format($producto->precio, 0, ",", ".")?>
					</td>
					<td>
						<?=$elemento["unidades"]?>
						<div id="cambiarUnidades">
							<a class="boton boton-verde" href="<?=BASE_URL?>controllers/CarritoControlador.php?opcion=4&indice=<?=$i?>">+</a>
							<a class="boton boton-verde" href="<?=BASE_URL?>controllers/CarritoControlador.php?opcion=5&indice=<?=$i?>">-</a>
						</div>			
					</td>
					<td>
						<a class="boton boton-carrito boton-rojo" href="<?=BASE_URL?>controllers/CarritoControlador.php?opcion=2&indice=<?=$i?>">Eliminar</a>
					</td>
				</tr>
			<?php 
			endforeach;
			?>
			</table>
			
			<div id="vaciarCarrito">
				<a class="boton boton-vaciar boton-rojo" href="<?=BASE_URL?>controllers/CarritoControlador.php?opcion=3">Vaciar carrito</a>
			</div>
			
			<div id="totalCarrito">
				<a class="boton boton-pedido" href="<?=BASE_URL?>Pedido/Hacer">Hacer pedido</a>
				<h3 id="total">Total: $<?=number_format(CarritoHelper::obtenerTotal(), 0, ",", ".")?></h3>
			</div>
		<?php 
		else:
		?>
			<h1 class="titulo-pagina-centrada">El carrito esta vacío</h1>
		<?php 
		endif;
		?>
		</div>	
		
	</div>
	<?php Helper::borrarSesion("limite_unidades"); ?>
</body>
</html>