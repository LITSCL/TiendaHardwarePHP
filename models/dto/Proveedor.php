<?php
class Proveedor {
	private $id;
	private $nombre;
	private $telefono;
	private $correo;
	
	public function getId() {
		return $this->id;
	}

	public function getNombre() {
		return $this->nombre;
	}

	public function getTelefono() {
		return $this->telefono;
	}

	public function getCorreo() {
		return $this->correo;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	public function setTelefono($telefono) {
		$this->telefono = $telefono;
	}

	public function setCorreo($correo) {
		$this->correo = $correo;
	}
}
?>