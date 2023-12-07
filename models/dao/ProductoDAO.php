<?php
if (file_exists('config/database.php')) {
	require_once 'config/database.php'; 
}
else {
	require_once '../config/database.php'; 
}
?>

<?php
class ProductoDAO {
	protected $db;
	
	public function __construct() {
		$this->db = Database::conectar();
	}
	
	public function save(Producto $p) {	
		$nombre = $this->db->real_escape_string($p->getNombre());
		$descripcion = $this->db->real_escape_string($p->getDescripcion());
		$precio = $this->db->real_escape_string($p->getPrecio());
		$stock = $this->db->real_escape_string($p->getStock());
		$imagen = $this->db->real_escape_string($p->getImagen());
		$categoria = $this->db->real_escape_string($p->getCategoriaFK());
		
		try {
			$query = $this->db->query("INSERT INTO producto VALUES(null, '{$nombre}', '{$descripcion}', {$precio}, {$stock}, '{$imagen}', {$categoria})");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function getAll() {		
		try {
			$query = $this->db->query("SELECT * FROM producto");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function getAllFK($columnaCategoria) {
		if ($columnaCategoria == false) {
			$columnaCategoria = "id";
		}
		
		try {
			$query = $this->db->query("SELECT producto.id, producto.descripcion, producto.precio, producto.stock, producto.imagen, producto.categoria, categoria.{$columnaCategoria} AS 'producto_{$columnaCategoria}' FROM producto, categoria WHERE producto.categoria_id = categoria.id");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function find($id) {
		try {
			$query = $this->db->query("SELECT * FROM producto WHERE id = {$id}");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function findAll($columna, $valor) {
		try {
			$query = $this->db->query("SELECT * FROM producto WHERE {$columna} = {$valor}");
			if (!$query) {
				$query = $this->db->query("SELECT * FROM producto WHERE {$columna} = '{$valor}'");
			}
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function findAllFK($columnaCategoria, $columna, $valor) {
		if ($columnaCategoria == false) {
			$columnaCategoria = "id";
		}
		
		try {
			$query = $this->db->query("SELECT producto.id, producto.descripcion, producto.precio, producto.stock, producto.imagen, producto.categoria, categoria.{$columnaCategoria} AS 'producto_{$columnaCategoria}' FROM producto, categoria WHERE producto.categoria_id = categoria.id AND producto.{$columna} = {$valor}");
			if (!$query) {
				$query = $this->db->query("SELECT producto.id, producto.descripcion, producto.precio, producto.stock, producto.imagen, producto.categoria, categoria.{$columnaCategoria} AS 'producto_{$columnaCategoria}' FROM producto, categoria WHERE producto.categoria_id = categoria.id AND producto.{$columna} = '{$valor}'");
			}
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function update(Producto $p) {
		$id = $this->db->real_escape_string($p->getId());
		$nombre = $this->db->real_escape_string($p->getNombre());
		$descripcion = $this->db->real_escape_string($p->getDescripcion());
		$precio = $this->db->real_escape_string($p->getPrecio());
		$stock = $this->db->real_escape_string($p->getStock());
		$imagen = $this->db->real_escape_string($p->getImagen());
		$categoria = $this->db->real_escape_string($p->getCategoriaFK());
		
		try {
			if ($imagen == "") {
				$query = $this->db->query("UPDATE producto SET nombre = '{$nombre}', descripcion = '{$descripcion}', precio = {$precio}, stock = {$stock}, categoria_id = {$categoria} WHERE id = {$id}");
			}
			else {
				$query = $this->db->query("UPDATE producto SET nombre = '{$nombre}', descripcion = '{$descripcion}', precio = {$precio}, stock = {$stock}, imagen = '{$imagen}', categoria_id = {$categoria} WHERE id = {$id}");
			}
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function updateOne($id, $columna, $valor) {
		$valor = $this->db->real_escape_string($valor);
		
		try {
			$query = $this->db->query("UPDATE producto SET {$columna} = {$valor} WHERE id = {$id}");
			if (!$query) {
				$query = $this->db->query("UPDATE producto SET {$columna} = '{$valor}' WHERE id = {$id}");
			}
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function delete($id) {
		try {
			$query = $this->db->query("DELETE FROM producto WHERE id = {$id}");
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