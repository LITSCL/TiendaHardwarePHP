<?php
if (file_exists('config/database.php')) {
	require_once 'config/database.php'; 
}
else {
	require_once '../config/database.php'; 
}
?>

<?php
class PedidoDAO {
	protected $db;
	
	public function __construct() {
		$this->db = Database::conectar();
	}
	
	public function save(Pedido $p) {	
		$ciudad = $this->db->real_escape_string($p->getCiudad());
		$comuna = $this->db->real_escape_string($p->getComuna());
		$calle = $this->db->real_escape_string($p->getCalle());
		$coste = $this->db->real_escape_string($p->getCoste());
		$usuario = $this->db->real_escape_string($p->getUsuarioFK());
		
		try {
			$query = $this->db->query("INSERT INTO pedido VALUES(null, '{$ciudad}', '{$comuna}', '{$calle}', {$coste}, 'Confirmado', CURDATE(), CURTIME(), '{$usuario}')");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function getAll() {	
		try {
			$query = $this->db->query("SELECT * FROM pedido");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function getAllFK($columnaUsuario) {
		if ($columnaUsuario == false) {
			$columnaUsuario = "id";
		}
		
		try {
			$query = $this->db->query("SELECT pedido.id, pedido.ciudad, pedido.comuna, pedido.calle, pedido.coste, pedido.estado, pedido.fecha, pedido.hora, usuario.{$columnaUsuario} AS 'usuario_{$columnaUsuario}' FROM pedido, usuario WHERE pedido.usuario_id = usuario.id");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function find($id) {
		try {
			$query = $this->db->query("SELECT * FROM pedido WHERE id = {$id}");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function findFK($columnaUsuario, $id) {
		if ($columnaUsuario == false) {
			$columnaUsuario = "id";
		}
		
		$query = $this->db->query("SELECT pedido.id, pedido.ciudad, pedido.comuna, pedido.calle, pedido.coste, pedido.estado, pedido.fecha, pedido.hora, usuario.{$columnaUsuario} AS 'usuario_{$columnaUsuario}' FROM pedido, usuario WHERE pedido.usuario_id = usuario.id AND pedido.id = {$id}");
		return $query;
	}
	
	public function findAll($columna, $valor) {
		try {
			$query = $this->db->query("SELECT * FROM pedido WHERE {$columna} = {$valor}");
			if (!$query) {
				$query = $this->db->query("SELECT * FROM pedido WHERE {$columna} = '{$valor}'");
			}
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function findAllFK($columnaUsuario, $columna, $valor) {
		if ($columnaUsuario == false) {
			$columnaUsuario = "id";
		}
		try {
			$query = $this->db->query("SELECT pedido.id, pedido.ciudad, pedido.comuna, pedido.calle, pedido.coste, pedido.estado, pedido.fecha, pedido.hora, usuario.{$columnaUsuario} AS 'usuario_{$columnaUsuario}' FROM pedido, usuario WHERE pedido.usuario_id = usuario.id AND pedido.{$columna} = {$valor}");
			if (!$query) {
				$query = $this->db->query("SELECT pedido.id, pedido.ciudad, pedido.comuna, pedido.calle, pedido.coste, pedido.estado, pedido.fecha, pedido.hora, usuario.{$columnaUsuario} AS 'usuario_{$columnaUsuario}' FROM pedido, usuario WHERE pedido.usuario_id = usuario.id AND pedido.{$columna} = '{$valor}'");
			}
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function update(Pedido $p) {
		$id = $this->db->real_escape_string($p->getId());
		$ciudad = $this->db->real_escape_string($p->getCiudad());
		$comuna = $this->db->real_escape_string($p->getComuna());
		$calle = $this->db->real_escape_string($p->getCalle());
		$coste = $this->db->real_escape_string($p->getCoste());
		$estado = $this->db->real_escape_string($p->getEstado());
		$fecha = $this->db->real_escape_string($p->getFecha());
		$hora = $this->db->real_escape_string($p->getHora());
		$usuario = $this->db->real_escape_string($p->getUsuarioFK());
		
		try {
			$query = $this->db->query("UPDATE pedido SET ciudad = '{$ciudad}', comuna = '{$comuna}', calle = '{$calle}', coste = {$coste}, estado = '{$estado}', fecha = '{$fecha}', hora = '{$hora}', usuario_id = {$usuario} WHERE id = {$id}");
		} catch (Exception $ex) {
			$query = false;
		}
		return $query;
	}
	
	public function updateOne($id, $columna, $valor) {
		$valor = $this->db->real_escape_string($valor);
		
		try {
			$query = $this->db->query("UPDATE pedido SET {$columna} = {$valor} WHERE id = {$id}");
			if (!$query) {
				$query = $this->db->query("UPDATE pedido SET {$columna} = '{$valor}' WHERE id = {$id}");
			}
		} catch (Exception $ex) {
			$query = false;
		}	
		return $query;
	}
	
	public function delete($id) {
		try {
			$query = $this->db->query("DELETE FROM pedido WHERE id = {$id}");
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