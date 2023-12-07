<?php
if (file_exists('config/database.php')) {
	require_once 'config/database.php';
}
else {
	require_once '../config/database.php';
}
?>

<?php
class UsuarioDAO {
	protected $db;
	
	public function __construct() {
		$this->db = Database::conectar();
	}
	
	public function save(Usuario $u) {	
		$correo = $this->db->real_escape_string($u->getCorreo());
		$clave = password_hash($this->db->real_escape_string($u->getClave()), PASSWORD_BCRYPT);
		$tipo = $this->db->real_escape_string($u->getTipo());
		$primerNombre = $this->db->real_escape_string($u->getPrimerNombre());
		$segundoNombre = $this->db->real_escape_string($u->getSegundoNombre());
		$apellidoPaterno = $this->db->real_escape_string($u->getApellidoPaterno());
		$apellidoMaterno = $this->db->real_escape_string($u->getApellidoMaterno());
		$imagen = $this->db->real_escape_string($u->getImagen());
		
		try {
			$query = $this->db->query("INSERT INTO usuario VALUES(null, '{$correo}', '{$clave}', '{$tipo}', '{$primerNombre}', '{$segundoNombre}', '{$apellidoPaterno}', '{$apellidoMaterno}', '{$imagen}')");
		} catch (Exception $ex) {
			$query = false;		
		}	
		return $query;
	}
	
	public function getAll() {
		try {
			$query = $this->db->query("SELECT * FROM usuario");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function find($id) {
		try {
			$query = $this->db->query("SELECT * FROM usuario WHERE id = {$id}");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function findOne($columna, $valor) {
		try {
			$query = $this->db->query("SELECT * FROM usuario WHERE {$columna} = {$valor} LIMIT 1");
			if (!$query) {
				$query = $this->db->query("SELECT * FROM usuario WHERE {$columna} = '{$valor}' LIMIT 1");
			}
		} catch (Exception $ex) {
			$query = false;
		}
		
		return $query;
	}
	
	public function findAll($columna, $valor) {
		try {
			$query = $this->db->query("SELECT * FROM usuario WHERE {$columna} = {$valor}");
			if (!$query) {
				$query = $this->db->query("SELECT * FROM usuario WHERE {$columna} = '{$valor}'");
			}
		} catch (Exception $ex) {
			$query = false;
		}

		return $query;
	}
	
	public function update(Usuario $u) {
		$id =  $_SESSION["usuario"]->id;
		$correoNuevo = $this->db->real_escape_string($u->getCorreo());
		
		if ($u->getClave() == "") {
			$clave = $_SESSION["usuario"]->clave;
		}
		else {
			$clave = password_hash($this->db->real_escape_string($u->getClave()), PASSWORD_BCRYPT);
		}

		$primerNombre = $this->db->real_escape_string($u->getPrimerNombre());
		$segundoNombre = $this->db->real_escape_string($u->getSegundoNombre());
		$apellidoPaterno = $this->db->real_escape_string($u->getApellidoPaterno());
		$apellidoMaterno = $this->db->real_escape_string($u->getApellidoMaterno());
		$imagen = $this->db->real_escape_string($u->getImagen());
		
		try {
			if ($imagen == "") {
				$query = $this->db->query("UPDATE usuario SET correo = '{$correoNuevo}', clave = '{$clave}', primer_nombre = '{$primerNombre}', segundo_nombre = '{$segundoNombre}', apellido_paterno = '{$apellidoPaterno}', apellido_materno = '{$apellidoMaterno}' WHERE id = {$id}");
			}
			else {
				$query = $this->db->query("UPDATE usuario SET correo = '{$correoNuevo}', clave = '{$clave}', primer_nombre = '{$primerNombre}', segundo_nombre = '{$segundoNombre}', apellido_paterno = '{$apellidoPaterno}', apellido_materno = '{$apellidoMaterno}', imagen = '{$imagen}' WHERE id = {$id}");
			}
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function delete($id) {
		try {
			$query = $this->db->query("DELETE FROM usuario WHERE id = '{$id}'");
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