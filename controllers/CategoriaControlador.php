<?php
if (file_exists('config/parameters.php')) {
	require_once 'config/parameters.php';
}
else {
	require_once '../config/parameters.php';
}
?>

<?php
class CategoriaControlador {
	
	public function controlador() { 
		require_once '../models/dto/Categoria.php';
		require_once '../models/dao/CategoriaDAO.php';
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
					
					if ($nombre) {					
						$daoCategoria = new CategoriaDAO();
						$c = new Categoria();
						
						$c->setNombre($nombre);
						
						if ($daoCategoria->save($c)) {
							$_SESSION["crear_categoria"] = "Exitoso";
						} else {
							$_SESSION["crear_categoria"] = "Fallido";
						}
						header("Location: " . BASE_URL . "Categoria/Crear");
					}
					break;
				case "2": //Modificar.
					AutorizacionHelper::validarAdministrador();
					
					$id = isset($_POST["id"]) ? $_POST["id"] : false;
					$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;

					if ($id && $nombre) {
						$daoCategoria = new CategoriaDAO();
						$c = new Categoria();
						
						$c->setId($id);
						$c->setNombre($nombre);

						if ($daoCategoria->update($c)) {
							$_SESSION["modificar_categoria"] = "Exitoso";
						} else {
							$_SESSION["modificar_categoria"] = "Fallido";
						}
						header("Location: " . BASE_URL . "Categoria/Modificar&id=$id");		
					}
					else {
						header("Location: " . BASE_URL);
					}
					break;
				case "3": //Eliminar.
					AutorizacionHelper::validarAdministrador();
					
					$id = isset($_GET["id"]) ? $_GET["id"] : false;
					
					if ($id) {
						$daoCategoria = new CategoriaDAO();
						
						if ($daoCategoria->delete($id)) {
							$_SESSION["eliminar_categoria"] = "Exitoso";
						}
						else {
							$_SESSION["eliminar_categoria"] = "Fallido";
						}
						header("Location: " . BASE_URL . "Categoria/Listar");
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
		
		require_once 'views/models/categoria/crear.php';
	}
	
	public function renderizarVistaListar() {
		AutorizacionHelper::validarAdministrador();
		
		require_once 'models/dto/Categoria.php';
		require_once 'models/dao/CategoriaDAO.php';
		require_once 'helpers/PaginadorHelper.php';
		
		$paginadorHelper = new PaginadorHelper("categoria", 15);
		
		require_once 'views/models/categoria/listar.php';
	}
	
	public function renderizarVistaModificar() {
		AutorizacionHelper::validarAdministrador();
		
		require_once 'models/dao/CategoriaDAO.php';
		
		if (isset($_GET["id"])) {
			$daoCategoria = new CategoriaDAO();
			$categoria = $daoCategoria->find($_GET["id"]);
			
			if ($categoria->num_rows > 0) {
				require_once 'views/models/categoria/modificar.php';
			}
			else {
				header("Location: " . BASE_URL);
			}	
		}
		else {
			header("Location: " . BASE_URL);
		}
	}
	
	public function renderizarVistaMostrar() {
		require_once 'models/dao/CategoriaDAO.php';
		require_once 'models/dao/ProductoDAO.php';
		require_once 'helpers/PaginadorHelper.php';
		
		if (isset($_GET["id"])) {
			$paginadorHelper = new PaginadorHelper("producto", 15, "WHERE categoria_id = '{$_GET["id"]}'", "id", $_GET["id"]);
			require_once 'views/models/categoria/mostrar.php';
		}
		else {
			header("Location: " . BASE_URL);
		}
	}

}

if (isset($_POST["opcion"]) || isset($_GET["opcion"])) {
	session_start();
	$cc = new CategoriaControlador();
	$cc->controlador();
}
?>