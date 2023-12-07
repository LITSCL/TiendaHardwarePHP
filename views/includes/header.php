<?php require_once "models/dao/CategoriaDAO.php"; ?>

<?php 
$daoCategoria = new CategoriaDAO();
$categorias = $daoCategoria->getAll();
?>

<header>
<?php 
if (!isset($_SESSION["usuario"])):
?>
	<nav id="navDefecto">
		<input id="checkbox" type="checkbox">
		<label class="boton-checkbox" for="checkbox"> 
			<i class="fas fa-bars"></i> 
		</label>
		<div class="contenido-navegacion">
			<div class="navegacion">
				<ul>
					<li><a href="<?=BASE_URL?>">Inicio</a></li>
				<?php 
				while ($categoria = $categorias->fetch_object()):
				?>
					<li><a href="<?=BASE_URL?>Categoria/Mostrar&id=<?=$categoria->id?>"><?=$categoria->nombre?></a></li>
				<?php 
				endwhile;
				?>
				</ul>
			</div>
	
			<div class="usuario">
				<ul>
					<li><a class="accion" href="<?=BASE_URL?>Carrito/Mostrar"><i class="fas fa-shopping-cart" title="Carrito"></i></a></li>
					<li><a href="<?=BASE_URL?>Usuario/IniciarSesion">Iniciar Sesión</a></li>
					<li><a href="<?=BASE_URL?>Usuario/Registrarse">Registrarse</a></li>
				</ul>
			</div>
		</div>
	</nav>
<?php 
endif;
?>

<?php 
if (isset($_SESSION["usuario"]) && $_SESSION["usuario"]->tipo == "Cliente"):
?>
	<nav id="navCliente">
		<input id="checkbox" type="checkbox">
		<label class="boton-checkbox" for="checkbox"> 
			<i class="fas fa-bars"></i> 
		</label>
		<div class="contenido-navegacion">
			<div class="navegacion">
				<ul>
					<li><a href="<?=BASE_URL?>">Inicio</a></li>
				<?php 
				while ($categoria = $categorias->fetch_object()):
				?>
					<li><a href="<?=BASE_URL?>Categoria/Mostrar&id=<?=$categoria->id?>"><?=$categoria->nombre?></a></li>
				<?php 
				endwhile;
				?>
				</ul>
			</div>
	
			<div class="usuario">
				<ul>
					<li><a class="accion" href="<?=BASE_URL?>Carrito/Mostrar"><i class="fas fa-shopping-cart" title="Carrito"></i></a></li>
					<li><a class="accion" href="<?=BASE_URL?>Pedido/MisPedidos"><i class="fas fa-parachute-box" title="Pedidos"></i></a></li>
					<li><a class="accion" href="<?=BASE_URL?>Producto/Favoritos"><i class="fas fa-heart" title="Favoritos"></i></a></li>
					<li><a href="<?=BASE_URL?>Usuario/EditarPerfil"><?=$_SESSION["usuario"]->primer_nombre?></a></li>
					<li><img class="avatar" src="<?=BASE_URL?>uploads/models/usuario/images/<?=$_SESSION["usuario"]->imagen?>"/></li>
					<li><a href="<?=BASE_URL?>controllers/UsuarioControlador.php?opcion=3"><img class="cerrar" src="<?=BASE_URL?>assets/img/close.png" title="Cerrar Sesión"/></a></li>
				</ul>
			</div>
		</div>
	</nav>
<?php 
endif;
?>

<?php 
if (isset($_SESSION["usuario"]) && $_SESSION["usuario"]->tipo == "Administrador"):
?>
	<nav id="navAdministrador">
		<input id="checkbox" type="checkbox">
		<label class="boton-checkbox" for="checkbox"> 
			<i class="fas fa-bars"></i> 
		</label>
		<div class="contenido-navegacion">
			<div class="navegacion">
				<ul>
					<li><a href="<?=BASE_URL?>">Inicio</a></li>
					<li><a href="<?=BASE_URL?>Categoria/Crear">Crear Categoría</a></li>
					<li><a href="<?=BASE_URL?>Producto/Crear">Crear Producto</a></li>
					<li><a href="<?=BASE_URL?>Proveedor/Crear">Crear Proveedor</a></li>
					<li><a href="<?=BASE_URL?>Categoria/Listar">Listar Categorías</a></li>
					<li><a href="<?=BASE_URL?>Producto/Listar">Listar Productos</a></li>
					<li><a href="<?=BASE_URL?>Proveedor/Listar">Listar Proveedores</a></li>
					<li><a href="<?=BASE_URL?>Pedido/Listar">Listar Pedidos</a></li>
				</ul>
			</div>
	
			<div class="usuario">
				<ul>
					<li><a href="<?=BASE_URL?>Usuario/EditarPerfil"><?=$_SESSION["usuario"]->primer_nombre?></a></li>
					<li><img class="avatar" src="<?=BASE_URL?>uploads/models/usuario/images/<?=$_SESSION["usuario"]->imagen?>"/></li>
					<li><a href="<?=BASE_URL?>controllers/UsuarioControlador.php?opcion=3"><img class="cerrar" src="<?=BASE_URL?>assets/img/close.png" title="Cerrar Sesión"/></a></li>
				</ul>
			</div>
		</div>
	</nav>
<?php 
endif;
?>
</header>