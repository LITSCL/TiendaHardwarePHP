<?php
if (file_exists('config/parameters.php')) {
	require_once 'config/parameters.php';
}
else {
	require_once '../config/parameters.php';
}
?>

<?php
class ProductoControlador {
	
	public function controlador() { 
		require_once '../models/dto/Producto.php';
		require_once '../models/dao/ProductoDAO.php';
		require_once '../helpers/Helper.php';
		require_once '../helpers/AutorizacionHelper.php';
		
		if (isset($_POST["opcion"]) || isset($_GET["opcion"])) {
			if (isset($_POST["opcion"])) {
				$opcion = $_POST["opcion"];
			}
			else {
				$opcion = $_GET["opcion"];
			}
			switch ($opcion) {
				case "1": //Crear.
					AutorizacionHelper::validarAdministrador();	
					
					$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
					$descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : false;
					$precio = isset($_POST["precio"]) ? $_POST["precio"] : false;
					$stock = isset($_POST["stock"]) ? $_POST["stock"] : false;
					$categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : false;
					
					$archivo = $_FILES["imagen"];
					$nombreArchivo = Helper::cadenaAleatoria() . "-" . $archivo["name"];
					$tipoArchivo = $archivo["type"];

					if ($nombre && $descripcion && $precio && $stock && $categoria) {
						if ($tipoArchivo == "image/jpg" || $tipoArchivo == "image/jpeg" || $tipoArchivo == "image/png") {
							if ($nombre && $descripcion && $precio && $stock && $categoria) {
								$daoProducto = new ProductoDAO();
								$p = new Producto();
								
								if (!is_dir("../uploads/models/producto/images")) {
									mkdir("../uploads/models/producto/images", 0777, true);
								}
								move_uploaded_file($archivo["tmp_name"], "../uploads/models/producto/images/" . $nombreArchivo);
								
								$p->setNombre($nombre);
								$p->setDescripcion($descripcion);
								$p->setPrecio($precio);
								$p->setStock($stock);
								$p->setImagen($nombreArchivo);
								$p->setCategoriaFK($categoria);
								
								if ($daoProducto->save($p)) {
									$_SESSION["crear_producto"] = "Exitoso";
								} else {
									$_SESSION["crear_producto"] = "Fallido";
								}
							}
							else {
								$_SESSION["crear_producto"] = "Fallido";
							}
						}
						else {
							$_SESSION["crear_producto"] = "Fallido";
						}
						header("Location: " . BASE_URL . "Producto/Crear");
					}
					else {
						header("Location: " . BASE_URL);
					}
					break;
				case "2": //Modificar.
					AutorizacionHelper::validarAdministrador();
					
					$id = isset($_POST["id"]) ? $_POST["id"] : false;
					$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
					$descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : false;
					$precio = isset($_POST["precio"]) ? $_POST["precio"] : false;
					$stock = isset($_POST["stock"]) ? $_POST["stock"] : false;
					$categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : false;
					
					$archivo = $_FILES["imagen"];
					$nombreArchivo = Helper::cadenaAleatoria() . "-" . $archivo["name"];
					$tipoArchivo = $archivo["type"];
					
					$nuevaImagen = false;
					$imagenSubida = false;
					if ($tipoArchivo != "") {
						$nuevaImagen = true;
						if ($tipoArchivo == "image/jpg" || $tipoArchivo == "image/jpeg" || $tipoArchivo == "image/png") {
							
							if (!is_dir("../uploads/models/producto/images")) {
								mkdir("../uploads/models/producto/images", 0777, true);
							}
							move_uploaded_file($archivo["tmp_name"], "../uploads/models/producto/images/" . $nombreArchivo);
							
							$daoProducto = new ProductoDAO();
							$producto = $daoProducto->find($id)->fetch_object();
							unlink("../uploads/models/producto/images/" . $producto->imagen);				
							
							$imagenSubida = true;
						}
						else {
							$_SESSION["modificar_producto"] = "Fallido";
						}
					}
					
					if ($nuevaImagen == true && $imagenSubida == true || $nuevaImagen == false) {
						if ($nombre && $descripcion && $precio && $stock && $categoria) {
							$daoProducto = new ProductoDAO();
							$p = new Producto();
							
							$p->setId($id);
							$p->setNombre($nombre);
							$p->setDescripcion($descripcion);
							$p->setPrecio($precio);
							$p->setStock($stock);
							
							if ($nuevaImagen == true && $imagenSubida == true) {
								$p->setImagen($nombreArchivo);
							}
							
							$p->setCategoriaFK($categoria);
							
							if ($daoProducto->update($p)) {
								$_SESSION["modificar_producto"] = "Exitoso";
							} else {
								$_SESSION["modificar_producto"] = "Fallido";
							}
						}
						else {
							$_SESSION["modificar_producto"] = "Fallido";
						}
					}
					else {
						$_SESSION["modificar_producto"] = "Fallido";
					}
					header("Location: " . BASE_URL . "Producto/Modificar&id=$id");
					break;
				case "3": //Eliminar.
					AutorizacionHelper::validarAdministrador();
					
					$id = isset($_GET["id"]) ? $_GET["id"] : false;
					
					if ($id) {
						$daoProducto = new ProductoDAO();
						
						if ($daoProducto->delete($id)) {
							$_SESSION["eliminar_producto"] = "Exitoso";
						}
						else {
							$_SESSION["eliminar_producto"] = "Fallido";
						}
						header("Location: " . BASE_URL . "Producto/Listar");
					}
					else {
						header("Location: " . BASE_URL);
					}
					break;
				default:
					return "No existe la opción";
			}
		}
		return "No se envió una opción válida para controlar";
	}
	
	public function renderizarVistaCrear() {
		AutorizacionHelper::validarAdministrador();
		
		require_once 'models/dao/CategoriaDAO.php';
		
		$daoCategoria = new CategoriaDAO();
		$categorias = $daoCategoria->getAll();
		
		require_once 'views/models/producto/crear.php';
	}
	
	public function renderizarVistaListar() {
		AutorizacionHelper::validarAdministrador();
		
		require_once 'models/dto/Producto.php';
		require_once 'models/dao/ProductoDAO.php';
		require_once 'helpers/PaginadorHelper.php';
		
		$paginadorHelper = new PaginadorHelper("producto", 15);
		
		require_once 'views/models/producto/listar.php';
	}
	
	public function renderizarVistaModificar() {
		AutorizacionHelper::validarAdministrador();
		
		require_once 'models/dao/ProductoDAO.php';
		require_once 'models/dao/CategoriaDAO.php';
		
		if (isset($_GET["id"])) {
			$daoProducto = new ProductoDAO();
			$daoCategoria = new CategoriaDAO();
			$producto = $daoProducto->find($_GET["id"]);
			$categorias = $daoCategoria->getAll();
			
			if ($producto->num_rows > 0) {
				require_once 'views/models/producto/modificar.php';
			}
			else {
				header("Location: " . BASE_URL);
			}	
		}
		else {
			header("Location: " . BASE_URL);
		}	
	}
	
	public function renderizarVistaFavoritos() {
		AutorizacionHelper::validarCliente();
		
		require_once 'models/dto/Producto.php';
		require_once 'models/dao/ProductoDAO.php';
		require_once 'helpers/PaginadorHelper.php';
		
		$paginadorHelper = new PaginadorHelper("producto", 15, "INNER JOIN producto_usuario ON producto.id = producto_usuario.producto_id AND producto_usuario.usuario_id = {$_SESSION["usuario"]->id}");
		
		require_once 'views/models/producto/favoritos.php';
	}

}

if (isset($_POST["opcion"]) || isset($_GET["opcion"])) {
	session_start();
	$pc = new ProductoControlador();
	$pc->controlador();
}
?>