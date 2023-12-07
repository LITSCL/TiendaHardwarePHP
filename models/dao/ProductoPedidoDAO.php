<?php
if (file_exists('config/database.php')) {
	require_once 'config/database.php'; 
}
else {
	require_once '../config/database.php'; 
}
?>

<?php require_once '../models/dao/ProductoDAO.php'; ?>

<?php
class ProductoPedidoDAO {
	protected $db;
	
	public function __construct() {
		$this->db = Database::conectar();
	}
	
	public function save() {
		$query = $this->db->query("SELECT MAX(id) AS 'id' FROM pedido WHERE usuario_id = {$_SESSION["usuario"]->id}");
		$idPedido = $query->fetch_object()->id;
		
		foreach ($_SESSION["carrito"] as $elemento) {
			$producto = $elemento["objeto"];
		
			$stockActual = $producto->stock;
			$stockNuevo = $stockActual - $elemento["unidades"];
			
			$daoProducto = new ProductoDAO();
			$daoProducto->updateOne($producto->id, "stock", $stockNuevo);
			
			$query = $this->db->query("INSERT INTO producto_pedido VALUES(null, {$elemento['unidades']}, {$producto->id}, {$idPedido})");
		}
		return $query;
	}
	
	public function getAll() {
		try {
			$query = $this->db->query("SELECT * FROM producto_pedido");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function getAllFK($columnaPedido, $columnaProducto) {
		if ($columnaProducto == false) {
			$columnaProducto = "id";
		}
		
		if ($columnaPedido == false) {
			$columnaPedido = "id";
		}

		try {
			$query = $this->db->query("SELECT producto_pedido.id, producto.{$columnaProducto} AS 'producto_{$columnaProducto}', pedido.{$columnaPedido} AS 'pedido_{$columnaPedido}' FROM producto_pedido, producto, pedido WHERE producto_pedido.producto_id = producto.id AND producto_pedido.pedido_id = pedido.id");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function find($id) {
		try {
			$query = $this->db->query("SELECT * FROM producto_pedido WHERE id = {$id}");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function findAll($columna, $valor) {
		try {
			$query = $this->db->query("SELECT * FROM producto_pedido WHERE {$columna} = {$valor}");
			if (!$query) {
				$query = $this->db->query("SELECT * FROM producto_pedido WHERE {$columna} = '{$valor}'");
			}
		} catch (Exception $ex) {
			$query = false;
		}
		
		return $query;
	}
	
	public function update(ProductoPedido $pp) {
		$id = $this->db->real_escape_string($pp->getId());
		$pedido = $this->db->real_escape_string($pp->getPedidoFK());
		$producto = $this->db->real_escape_string($pp->getProductoFK());
		$unidades = $this->db->real_escape_string($pp->getUnidades());
		
		try {
			$query = $this->db->query("UPDATE producto_pedido SET producto_id = {$producto}, pedido_id = {$pedido}, unidades = {$unidades} WHERE id = {$id}");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function delete($id) {
		try {
			$query = $this->db->query("DELETE FROM producto_pedido WHERE id = {$id}");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function customQuery($sql) {
		try {
			$query = $this->db->query($sql);
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
}
?>