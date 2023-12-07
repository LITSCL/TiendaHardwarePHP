<?php
if (file_exists('config/database.php')) {
	require_once 'config/database.php'; 
}
else {
	require_once '../config/database.php'; 
}
?>

<?php
class CategoriaDAO {
	protected $db;
	
	public function __construct() {
		$this->db = Database::conectar();
	}
	
	public function save(Categoria $c) {	
		$nombre = $this->db->real_escape_string($c->getNombre());
		
		try {
			$query = $this->db->query("INSERT INTO categoria VALUES(null, '{$nombre}')");
		} catch (Exception $ex) {
			$query = false;
		}	
		return $query;
	}
	
	public function getAll() {
		try {
			$query = $this->db->query("SELECT * FROM categoria");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function find($id) {
		try {
			$query = $this->db->query("SELECT * FROM categoria WHERE id = {$id}");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function findAll($columna, $valor) {
		try  {
			$query = $this->db->query("SELECT * FROM categoria WHERE {$columna} = {$valor}");
			if (!$query) {
				$query = $this->db->query("SELECT * FROM categoria WHERE {$columna} = '{$valor}'");
			}
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function update(Categoria $c) {
		$id = $this->db->real_escape_string($c->getId());
		$nombre = $this->db->real_escape_string($c->getNombre());
		
		try {
			$query = $this->db->query("UPDATE categoria SET nombre = '{$nombre}' WHERE id = {$id}");
		} catch (Exception $ex) {
			$query = false;
		}		
		return $query;
	}
	
	public function delete($id) {
		try {
			$query = $this->db->query("DELETE FROM categoria WHERE id = {$id}");
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