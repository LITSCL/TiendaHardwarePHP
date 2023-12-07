<?php 
if ($formato == "tarjeta"):
?>
	<div class="tarjeta">
		//	
	</div>
<?php 
elseif ($formato == "tabla"):
?>
	<tr>
		<td><?=$objeto->id?></td>
		<td><?=$objeto->nombre?></td>
		<td><a class="boton boton-amarillo" href="<?=BASE_URL?>Categoria/Modificar&id=<?=$objeto->id?>">Modificar</a></td>
		<td><a class="boton boton-rojo" href="<?=BASE_URL?>controllers/CategoriaControlador.php?opcion=3&id=<?=$objeto->id?>">Eliminar</a></td>
	</tr>
<?php 
endif;
?>