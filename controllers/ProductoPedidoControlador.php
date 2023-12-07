<?php
if (file_exists('config/parameters.php')) {
	require_once 'config/parameters.php';
}
else {
	require_once '../config/parameters.php';
}
?>

<?php
class ProductoPedidoControlador {
	
	public function controlador() { 
		require_once '../models/dto/ProductoPedido.php';
		require_once '../models/dao/ProductoPedidoDAO.php';
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
	$ppc = new ProductoPedidoControlador();
	$ppc->controlador();
}
?>