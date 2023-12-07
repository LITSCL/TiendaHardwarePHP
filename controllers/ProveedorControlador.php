<?php
if (file_exists('config/parameters.php')) {
	require_once 'config/parameters.php';
}
else {
	require_once '../config/parameters.php';
}
?>

<?php
class ProveedorControlador {
	
	public function controlador() { 
		require_once '../models/dto/Proveedor.php';
		require_once '../models/dao/ProveedorDAO.php';
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
					$telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : false;
					$correo = isset($_POST["correo"]) ? $_POST["correo"] : false;
					
					if ($nombre && $telefono && $correo) {				
						$daoProveedor = new ProveedorDAO();
						$p = new Proveedor();
						
						$p->setNombre($nombre);
						$p->setTelefono($telefono);
						$p->setCorreo($correo);
						
						if ($daoProveedor->save($p)) {
							$_SESSION["crear_proveedor"] = "Exitoso";
						} else {
							$_SESSION["crear_proveedor"] = "Fallido";
						}
						header("Location: " . BASE_URL . "Proveedor/Crear");
					}
					else {
						header("Location: " . BASE_URL);
					}
					break;
				case "2": //Modificar.
					AutorizacionHelper::validarAdministrador();
					
					$id = isset($_POST["id"]) ? $_POST["id"] : false;
					$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
					$telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : false;
					$correo = isset($_POST["correo"]) ? $_POST["correo"] : false;
					
					if ($id && $nombre && $telefono && $correo) {
						$daoProveedor = new ProveedorDAO();
						$p = new Proveedor();
						
						$p->setId($id);
						$p->setNombre($nombre);
						$p->setTelefono($telefono);
						$p->setCorreo($correo);
						
						if ($daoProveedor->update($p)) {
							$_SESSION["modificar_proveedor"] = "Exitoso";
						} else {
							$_SESSION["modificar_proveedor"] = "Fallido";
						}
						header("Location: " . BASE_URL . "Proveedor/Modificar&id=$id");
					}
					else {
						header("Location: " . BASE_URL);
					}
					break;
				case "3": //Eliminar.
					AutorizacionHelper::validarAdministrador();
					
					$id = isset($_GET["id"]) ? $_GET["id"] : false;
					
					if ($id) {
						$daoProveedor = new ProveedorDAO();
						
						if ($daoProveedor->delete($id)) {
							$_SESSION["eliminar_proveedor"] = "Exitoso";
						}
						else {
							$_SESSION["eliminar_proveedor"] = "Fallido";
						}
						header("Location: " . BASE_URL . "Proveedor/Listar");
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
		
		require_once "views/models/proveedor/crear.php";
	}
	
	public function renderizarVistaListar() {
		AutorizacionHelper::validarAdministrador();
		
		require_once 'models/dto/Proveedor.php';
		require_once 'models/dao/ProveedorDAO.php';
		require_once 'helpers/PaginadorHelper.php';
		
		$paginadorHelper = new PaginadorHelper("proveedor", 15);
		
		require_once 'views/models/proveedor/listar.php';
	}
	
	public function renderizarVistaModificar() {
		AutorizacionHelper::validarAdministrador();
		
		require_once 'models/dao/ProveedorDAO.php';
		
		if (isset($_GET["id"])) {
			$daoProveedor = new ProveedorDAO();
			$proveedor = $daoProveedor->find($_GET["id"]);
			
			if ($proveedor->num_rows > 0) {
				require_once 'views/models/proveedor/modificar.php';
			}
			else {
				header("Location: " . BASE_URL);
			}		
		}
		else {
			header("Location: " . BASE_URL);
		}
	}

}

if (isset($_POST["opcion"]) || isset($_GET["opcion"])) {
	session_start();
	$pc = new ProveedorControlador();
	$pc->controlador();
}
?>