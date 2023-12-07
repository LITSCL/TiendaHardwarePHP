<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Editar Perfil</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<div class="contenido">
	
		<div class="contenedor-formulario">
			<h1>Editar Perfil</h1>
			<?php 
			if (isset($_SESSION["editar_perfil"]) && $_SESSION["editar_perfil"] == "Exitoso"): 
			?>
				<strong class="alerta alerta-verde">Perfil editado exitosamente</strong>
			<?php 
			endif;
			?>
			
			<?php 
			if (isset($_SESSION["editar_perfil"]) && $_SESSION["editar_perfil"] == "Fallido"):
			?>
				<strong class="alerta alerta-roja">Error al editar el perfil</strong>
			<?php 
			endif;
			?>
			<form action="<?=BASE_URL?>controllers/UsuarioControlador.php" method="POST" enctype="multipart/form-data">
				<label for="correo">Correo</label>
				<input type="email" name="correo" value="<?=$usuario->correo?>" required/>
				<label for="clave">Contraseña</label>
				<input type="password" name="clave" value="Clave no cambiada" required/>
				<label for="primerNombre">Primer Nombre</label>
				<input type="text" name="primerNombre" value="<?=$usuario->primer_nombre?>" required/>
				<label for="segundoNombre">Segundo Nombre</label>
				<input type="text" name="segundoNombre" value="<?=$usuario->segundo_nombre?>" required/>
				<label for="apellidoPaterno">Apellido Paterno</label>
				<input type="text" name="apellidoPaterno" value="<?=$usuario->apellido_paterno?>" required/>
				<label for="apellidoMaterno">Apellido Materno</label>
				<input type="text" name="apellidoMaterno" value="<?=$usuario->apellido_materno?>" required/>
				<label for="imagen">Imagen</label>
				<input type="file" name="imagen"/>
				<div class="contenedor-modificar-imagen">
					<img src="<?=BASE_URL?>uploads/models/usuario/images/<?=$usuario->imagen?>"/>
				</div>
				<button type="submit" name="opcion" value="4">Editar</button>
			</form>
		</div>
		
	</div>
	<?php Helper::borrarSesion("editar_perfil"); ?>
</body>
</html>