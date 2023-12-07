<?php
if (file_exists('config/database.php')) {
	require_once 'config/database.php'; 
}
else {
	require_once '../config/database.php';
}
?>

<?php
class ProveedorDAO {
	protected $db;
	
	public function __construct() {
		$this->db = Database::conectar();
	}
	
	public function save(Proveedor $p) {	
		$nombre = $this->db->real_escape_string($p->getNombre());
		$telefono = $this->db->real_escape_string($p->getTelefono());
		$correo = $this->db->real_escape_string($p->getCorreo());
		
		try {
			$query = $this->db->query("INSERT INTO proveedor VALUES(null, '{$nombre}', '{$telefono}', '{$correo}')");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function getAll() {
		try {
			$query = $this->db->query("SELECT * FROM proveedor");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function find($id) {
		try {
			$query = $this->db->query("SELECT * FROM proveedor WHERE id = {$id}");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function findAll($columna, $valor) {
		try {
			$query = $this->db->query("SELECT * FROM proveedor WHERE {$columna} = {$valor}");
			if (!$query) {
				$query = $this->db->query("SELECT * FROM proveedor WHERE {$columna} = '{$valor}'");
			}
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function update(Proveedor $p) {
		$id = $this->db->real_escape_string($p->getId());
		$nombre = $this->db->real_escape_string($p->getNombre());
		$telefono = $this->db->real_escape_string($p->getTelefono());
		$correo = $this->db->real_escape_string($p->getCorreo());
		
		try {
			$query = $this->db->query("UPDATE proveedor SET nombre = '{$nombre}', telefono = '{$telefono}', correo = '{$correo}' WHERE id = {$id}");
		} catch (Exception $ex) {
			$query = false;
		}	
		return $query;
	}
	
	public function delete($id) {
		try {
			$query = $this->db->query("DELETE FROM proveedor WHERE id = {$id}");
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