<?php require_once 'models/dao/ProductoUsuarioDAO.php'; ?>

<?php 
$daoProductoUsuario = new ProductoUsuarioDAO();
$productosUsuario = $daoProductoUsuario->getAll();
?>

<?php 
if ($formato == "tarjeta"):
	$descripcionSeparada = explode(";", $objeto->descripcion); 
?>
	<div class="tarjeta">
	
		<div class="tarjeta-cabecera">
			<div class="contenedor-corazon">
			<?php
			$favorito = false;
			if (isset($_SESSION["usuario"]) && $_SESSION["usuario"]->tipo == "Cliente") {
				while ($productoUsuario = $productosUsuario->fetch_object()) {
					if ($productoUsuario->producto_id == $objeto->id && $productoUsuario->usuario_id == $_SESSION["usuario"]->id) {
						$favorito = true;
						break;
					}
				}
			}
			?>
			<?php 
			if ($favorito == true): 
			?>
				<img class="boton-like" data-idProducto="<?=$objeto->id?>" src="<?=BASE_URL?>assets/img/heart-red.png"/>
			<?php 
			else:
			?>
				<img class="boton-dislike" data-idProducto="<?=$objeto->id?>" src="<?=BASE_URL?>assets/img/heart-gray.png"/>
			<?php 
			endif;
			?>
			</div>
			<h1><?=$objeto->nombre?></h1>
		</div>
		
		<div class="tarjeta-cuerpo">
			<img src="<?=BASE_URL?>uploads/models/producto/images/<?=$objeto->imagen?>"/>
			<h1>Descripción</h1>
			<ul>
			<?php 
			foreach ($descripcionSeparada as $descripcion):
			?>
				<li><?=$descripcion?></li>
			<?php 
			endforeach;
			?>
			</ul>
			<div class="contenedor-precio">
				$<?=number_format($objeto->precio, 0, ",", ".")?>
			</div>
			
			<div class="clearfix"></div>
			
			<div class="contenedor-disponibilidad">
				<span>Disponibilidad: </span> <?=$objeto->stock?>
			</div>
		</div>
		
		<div class="tarjeta-pie">
			<div>
				<a class="boton boton-verde" href="<?=BASE_URL?>controllers/CarritoControlador.php?opcion=1&id=<?=$objeto->id?>">Agregar al carrito</a>
			</div>
		</div>
		
	</div>
<?php 
elseif ($formato == "tabla"):
?>
	<tr>
		<td><?=$objeto->id?></td>
		<td><?=$objeto->nombre?></td>
		<td><?=$objeto->descripcion?></td>
		<td>$<?=number_format($objeto->precio, 0, ",", ".")?></td>
		<td><?=$objeto->stock?></td>
		<td><img src="<?=BASE_URL?>uploads/models/producto/images/<?=$objeto->imagen?>"/></td>
		<td><?=$objeto->categoria_id?></td>
		<td><a class="boton boton-amarillo" href="<?=BASE_URL?>Producto/Modificar&id=<?=$objeto->id?>">Modificar</a></td>
		<td><a class="boton boton-rojo" href="<?=BASE_URL?>controllers/ProductoControlador.php?opcion=3&id=<?=$objeto->id?>">Eliminar</a></td>
	</tr>
<?php 
endif;
?>