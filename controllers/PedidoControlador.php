<?php
if (file_exists('config/parameters.php')) {
	require_once 'config/parameters.php';
}
else {
	require_once '../config/parameters.php';
}
?>

<?php
class PedidoControlador {
	
	public function controlador() { 
		require_once '../models/dto/Pedido.php';
		require_once '../models/dao/PedidoDAO.php';
		require_once '../models/dto/ProductoPedido.php';
		require_once '../models/dao/ProductoPedidoDAO.php';
		require_once '../helpers/Helper.php';
		require_once '../helpers/AutorizacionHelper.php';
		require_once '../helpers/CarritoHelper.php';
		
		if (isset($_POST["opcion"]) || isset($_GET["opcion"])) {
			if (isset($_POST["opcion"])) {
				$opcion = $_POST["opcion"];
			}
			else {
				$opcion = $_GET["opcion"];
			}
			switch ($opcion) {
				case "1": //Crear.
					AutorizacionHelper::validarCliente();
					
					$ciudad = (isset($_POST["ciudad"])) ? $_POST["ciudad"] : false;
					$comuna = (isset($_POST["comuna"])) ? $_POST["comuna"] : false;
					$calle = (isset($_POST["calle"])) ? $_POST["calle"] : false;
					$coste = CarritoHelper::obtenerTotal();
					$idUsuario = $_SESSION["usuario"]->id;
					
					if ($ciudad && $comuna && $calle) {
						$daoPedido = new PedidoDAO();
						$p = new Pedido();
						
						$p->setCiudad($ciudad);
						$p->setComuna($comuna);
						$p->setCalle($calle);
						$p->setCoste($coste);
						$p->setUsuarioFK($idUsuario);
						
						if ($daoPedido->save($p)) {
							$daoProductoPedido = new ProductoPedidoDAO();
							if ($daoProductoPedido->save()) {
								$_SESSION["crear_pedido"] = "Exitoso";
								Helper::borrarSesion("carrito");
							}
							else {
								$_SESSION["crear_pedido"] = "Fallido";
							}
						} else {
							$_SESSION["crear_pedido"] = "Fallido";
						}
						header("Location: " . BASE_URL . "Pedido/Confirmado");
					}
					else {
						header("Location: " . BASE_URL);
					}
					break;
				case "2": //Cambiar Estado.
					AutorizacionHelper::validarAdministrador();
					
					if (isset($_POST["id"]) && isset($_POST["estado"])) {
						$daoPedido = new PedidoDAO();
						$daoPedido->updateOne($_POST["id"], "estado", $_POST["estado"]);
						header("Location: " . BASE_URL . "Pedido/Gestionar&id=" . $_POST["id"]);
					} else {
						header("Location: " . BASE_URL);
					}
					break;
				default:
					return "No existe la opción";
			}
		}
		return "No se envió una opción válida para controlar";
	}
	
	public function renderizarVistaHacer() {
		AutorizacionHelper::validarCliente();
		
		if (isset($_SESSION["carrito"]) && count($_SESSION["carrito"]) >= 1) {
			require_once 'views/models/pedido/hacer.php';
		}
		else {
			header("Location: " . BASE_URL);
		}
	}
	
	public function renderizarVistaConfirmado() {
		AutorizacionHelper::validarCliente();
		
		require_once 'models/dto/Pedido.php';
		require_once 'models/dto/Producto.php';
		require_once 'models/dao/PedidoDAO.php';
		require_once 'models/dao/ProductoDAO.php';
		
		if (isset($_SESSION["usuario"])) {
			$daoPedido = new PedidoDAO();
			$daoProducto = new ProductoDAO();
			
			$sql = "SELECT p.id, p.coste, p.estado FROM pedido p WHERE p.usuario_id = {$_SESSION["usuario"]->id} ORDER BY id DESC LIMIT 1";
			
			$datosPedido = $daoPedido->customQuery($sql);
			
			$idPedido = $daoPedido->customQuery($sql)->fetch_object()->id;
			
			$sql = "SELECT p.*, pp.unidades FROM producto p INNER JOIN producto_pedido pp ON p.id = pp.producto_id WHERE pp.pedido_id = {$idPedido}";
			
			$productosPedido = $daoProducto->customQuery($sql);
		}
		
		require_once 'views/models/pedido/confirmado.php';
	}
	
	public function renderizarVistaListar() {
		AutorizacionHelper::validarAdministrador();
		
		require_once 'models/dao/PedidoDAO.php';
		require_once 'helpers/PaginadorHelper.php';
		
		$paginadorHelper = new PaginadorHelper("pedido", 15);
		
		require_once 'views/models/pedido/listar.php';
	}
	
	public function renderizarVistaMisPedidos() {
		AutorizacionHelper::validarCliente();
		
		require_once 'models/dao/PedidoDAO.php';
		require_once 'helpers/PaginadorHelper.php';
		
		$paginadorHelper = new PaginadorHelper("pedido", 15, "WHERE usuario_id = '{$_SESSION["usuario"]->id}'");
		
		require_once 'views/models/pedido/mis_pedidos.php';
	}
	
	public function renderizarVistaDetalle() {
		AutorizacionHelper::validarCliente();
		
		require_once 'models/dto/Pedido.php';
		require_once 'models/dto/Producto.php';
		require_once 'models/dao/PedidoDAO.php';
		require_once 'models/dao/ProductoDAO.php';
		
		if (isset($_SESSION["usuario"]) && isset($_GET["id"])) {
			$daoPedido = new PedidoDAO();
			$daoProducto = new ProductoDAO();
			
			$sql = "SELECT p.id, p.coste, p.estado, p.usuario_id FROM pedido p WHERE id = {$_GET["id"]}";
			if ($daoPedido->customQuery($sql) != false) {
				$datosPedido = $daoPedido->customQuery($sql);
				
				$sql = "SELECT p.*, pp.unidades FROM producto p INNER JOIN producto_pedido pp ON p.id = pp.producto_id WHERE pp.pedido_id = {$_GET["id"]}";
				
				$productosPedido = $daoProducto->customQuery($sql);
				
				$pedido = $daoPedido->find($_GET["id"])->fetch_object();
				if (is_object($pedido)) {
					if ($pedido->usuario_id == $_SESSION["usuario"]->id) {
						require_once 'views/models/pedido/detalle.php';
					}
					else {
						$_SESSION["error_detalle_pedido"] = "El pedido no te pertenece";
						require_once 'views/models/pedido/detalle.php';
					}
				}
				else {
					$_SESSION["error_detalle_pedido"] = "El pedido no existe";
					require_once 'views/models/pedido/detalle.php';
				}
			}
			else {
				$_SESSION["error_detalle_pedido"] = "El pedido no existe";
				require_once 'views/models/pedido/detalle.php';
			}
		}
		else {
			header("Location: " . BASE_URL);
		}
	}
	
	public function renderizarVistaGestionar() {
		AutorizacionHelper::validarAdministrador();
		
		require_once 'models/dto/Pedido.php';
		require_once 'models/dto/Producto.php';
		require_once 'models/dao/PedidoDAO.php';
		require_once 'models/dao/ProductoDAO.php';
		
		if (isset($_SESSION["usuario"]) && isset($_GET["id"])) {
			$daoPedido = new PedidoDAO();
			$daoProducto = new ProductoDAO();
			
			$sql = "SELECT p.id, p.coste, p.estado FROM pedido p WHERE id = {$_GET["id"]}";
			
			$datosPedido = $daoPedido->customQuery($sql);
			
			$sql = "SELECT p.*, pp.unidades FROM producto p INNER JOIN producto_pedido pp ON p.id = pp.producto_id WHERE pp.pedido_id = {$_GET["id"]}";
			
			$productosPedido = $daoProducto->customQuery($sql);
		}
		else {
			header("Location: " . BASE_URL);
		}
		
		if ($datosPedido->num_rows > 0) {
			require_once 'views/models/pedido/gestionar.php';
		}
		else {
			header("Location: " . BASE_URL);
		}		
	}

}

if (isset($_POST["opcion"]) || isset($_GET["opcion"])) {
	session_start();
	$pc = new PedidoControlador();
	$pc->controlador();
}
?>