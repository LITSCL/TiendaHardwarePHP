<?php
if (file_exists('config/parameters.php')) {
	require_once 'config/parameters.php';
}
else {
	require_once '../config/parameters.php';
}
?>

<?php
class ProductoUsuarioControlador {
	
	public function controlador() { 
		require_once '../models/dto/ProductoUsuario.php';
		require_once '../models/dao/ProductoUsuarioDAO.php';
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
					if (isset($_SESSION["usuario"]) && $_SESSION["usuario"]->tipo == "Cliente") {
						$idUsuario = isset($_SESSION["usuario"]->id) ? $_SESSION["usuario"]->id : false;
						$idProducto = isset($_GET["id"]) ? $_GET["id"] : false;
						
						$daoProductoUsuario = new ProductoUsuarioDAO();
						$productoUsuario = $daoProductoUsuario->customQuery("SELECT * FROM producto_usuario WHERE producto_id = {$idProducto} AND usuario_id = {$idUsuario} LIMIT 1");
						
						if ($idUsuario && $idProducto) {
							if ($productoUsuario->num_rows == 0) {
								$pu = new ProductoUsuario();
								$pu->setUsuarioFK($idUsuario);
								$pu->setProductoFK($idProducto);
								
								$daoProductoUsuario->save($pu);
								
								echo json_encode(["mensaje" => "SERVIDOR: Has dado like correctamente"]);
							}
							else {
								echo json_encode(["mensaje" => "SERVIDOR: No has podido dar like correctamente"]);
							}
						}
					}
					elseif (isset($_SESSION["usuario"]) && $_SESSION["usuario"]->tipo == "Administrador") {
						echo json_encode(["mensaje" => "SERVIDOR: Eres administrador"]);
					}
					else {
						echo json_encode(["mensaje" => "SERVIDOR: No estas logeado"]);
					}
					break;
				case "2": //Eliminar.			
					if (isset($_SESSION["usuario"]) && $_SESSION["usuario"]->tipo == "Cliente") {
						$idUsuario = isset($_SESSION["usuario"]->id) ? $_SESSION["usuario"]->id : false;
						$idProducto = isset($_GET["id"]) ? $_GET["id"] : false;
						
						$daoProductoUsuario = new ProductoUsuarioDAO();
						$productoUsuario = $daoProductoUsuario->customQuery("SELECT * FROM producto_usuario WHERE  producto_id = {$idProducto} AND usuario_id = {$idUsuario} LIMIT 1");
						
						if ($idUsuario && $idProducto) {
							if ($productoUsuario->num_rows == 1) {							
								$daoProductoUsuario->delete($productoUsuario->fetch_object()->id);		
								echo json_encode(["mensaje" => "SERVIDOR: Has dado dislike correctamente"]);
							}
							else {
								echo json_encode(["mensaje" => "SERVIDOR: No has podido dar dislike correctamente"]);
							}
						}					
					}
					elseif (isset($_SESSION["usuario"]) && $_SESSION["usuario"]->tipo == "Administrador") {
						echo json_encode(["mensaje" => "SERVIDOR: Eres administrador"]);
					}
					else {
						echo json_encode(["mensaje" => "SERVIDOR: No estas logeado"]);
					}
					break;
				default:
					return "No existe la opción";
			}
		}
		return "No se envió una opción válida para controlar";
	}

}

if (isset($_POST["opcion"]) || isset($_GET["opcion"])) {
	session_start();
	$puc = new ProductoUsuarioControlador();
	$puc->controlador();
}
?>