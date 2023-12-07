<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Listar Proveedores</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<div class="contenido">
	
		<?php 
		if (isset($_SESSION["eliminar_proveedor"]) && $_SESSION["eliminar_proveedor"] == "Exitoso"): 
		?>
			<strong class="alerta alerta-verde">Proveedor eliminado exitosamente</strong>
		<?php 
		elseif (isset($_SESSION["eliminar_proveedor"]) && $_SESSION["eliminar_proveedor"] == "Fallido"): 
		?>
			<strong class="alerta alerta-roja">Error al eliminar el proveedor</strong>
		<?php 
		endif;
		?>
		<div id="contenedorTablaProveedores" class="contenedor-paginacion-objetos">
		<?php 
		if ($paginadorHelper->mostrarDatos("tabla", "paginacion_proveedor", array("ID", "Nombre", "Telefono", "Correo", "Acción 1", "Acción 2")) === true):
		?>
		<?php 
		elseif ($paginadorHelper->mostrarDatos("tabla", "paginacion_proveedor", array("ID", "Nombre", "Telefono", "Correo", "Acción 1", "Acción 2")) === "Pagina Inexistente"):
		?>
			<h1 class="titulo-pagina-centrada">No se han encontrado resultados en esta página</h1>
		<?php 
		elseif ($paginadorHelper->mostrarDatos("tabla", "paginacion_proveedor", array("ID", "Nombre", "Telefono", "Correo", "Acción 1", "Acción 2")) === "Sin Registros"):
		?>
			<h1 class="titulo-pagina-centrada">No hay proveedores</h1>
		<?php 
		endif;
		?>	
		</div>

		<div class="contenedor-paginacion-paginas">
			<?php $paginadorHelper->mostrarPaginas(BASE_URL . "Proveedor/Listar"); ?>
		</div>
		
	</div>
	<?php Helper::borrarSesion("eliminar_proveedor"); ?>
</body>
</html>