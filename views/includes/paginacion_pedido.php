<?php 
if ($formato == "tarjeta"):
?>
	<div class="tarjeta">
		//	
	</div>
<?php 
elseif ($formato == "tabla"):
?>
	<?php 
	if (isset($_SESSION["usuario"]) && $_SESSION["usuario"]->tipo == "Administrador"):
	?> 
		<tr>
			<td><?=$objeto->id?></td>
			<td><?=$objeto->ciudad?></td>
			<td><?=$objeto->comuna?></td>
			<td><?=$objeto->calle?></td>
			<td>$<?=number_format($objeto->coste, "0", ",", ".")?></td>
			<td><?=$objeto->estado?></td>
			<td><?=$objeto->fecha?></td>
			<td><?=$objeto->hora?></td>
			<td><?=$objeto->usuario_id?></td>
			<td><a class="boton boton-amarillo" href="<?=BASE_URL?>Pedido/Gestionar&id=<?=$objeto->id?>">Gestionar</a></td>
		</tr>
	<?php
	elseif (isset($_SESSION["usuario"]) && $_SESSION["usuario"]->tipo == "Cliente"):
	?>
		<tr>
			<td><a class="numeroPedidoRedireccionador" href="<?=BASE_URL?>Pedido/Detalle&id=<?=$objeto->id?>"><?=$objeto->id?></a></td>
			<td>$<?=number_format($objeto->coste, "0", ",", ".")?></td>
			<td><?=$objeto->fecha?></td>
			<td><?=$objeto->estado?></td>
		</tr>
	<?php 
	endif;
	?>
<?php 
endif;
?>