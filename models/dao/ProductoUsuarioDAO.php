<?php
if (file_exists('config/database.php')) {
	require_once 'config/database.php'; 
}
else {
	require_once '../config/database.php'; 
}
?>

<?php
class ProductoUsuarioDAO {
	protected $db;
	
	public function __construct() {
		$this->db = Database::conectar();
	}
	
	public function save(ProductoUsuario $pu) {	
		$producto = $this->db->real_escape_string($pu->getProductoFK());
		$usuario = $this->db->real_escape_string($pu->getUsuarioFK());
		
		try {
			$query = $this->db->query("INSERT INTO producto_usuario VALUES(null, {$producto}, {$usuario})");
		} catch (Exception $ex) {
			$query = false;
		}	
		return $query;
	}
	
	public function getAll() {
		try {
			$query = $this->db->query("SELECT * FROM producto_usuario");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function getAllFK($columnaUsuario, $columnaProducto) {
		if ($columnaProducto == false) {
			$columnaProducto = "id";
		}
		
		if ($columnaUsuario == false) {
			$columnaUsuario = "id";
		}
		
		try {
			$query = $this->db->query("SELECT producto_usuario.id, producto.{$columnaProducto} AS 'producto_{$columnaProducto}', usuario.{$columnaUsuario} AS 'usuario_{$columnaUsuario}' FROM producto_usuario, producto, usuario WHERE producto_usuario.producto_id = producto.id AND producto_usuario.usuario_id = usuario.id");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function find($id) {
		try {
			$query = $this->db->query("SELECT * FROM producto_usuario WHERE id = {$id}");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function findAll($columna, $valor) {
		try {
			$query = $this->db->query("SELECT * FROM producto_usuario WHERE {$columna} = {$valor}");
			if (!$query) {
				$query = $this->db->query("SELECT * FROM producto_usuario WHERE {$columna} = '{$valor}'");
			}
		} catch (Exception $ex) {
			$query = false;
		}
		
		return $query;
	}
	
	public function update(ProductoUsuario $pu) {
		$id = $this->db->real_escape_string($pu->getId());
		$producto = $this->db->real_escape_string($pu->getProductoFK());
		$usuario = $this->db->real_escape_string($pu->getUsuarioFK());
		
		try {
			$query = $this->db->query("UPDATE producto_usuario SET producto_id = {$producto}, usuario_id = {$usuario} WHERE id = {$id}");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function delete($id) {
		try {
			$query = $this->db->query("DELETE FROM producto_usuario WHERE id = {$id}");
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