<?php
class Usuario {
	private $id;
	private $correo;
	private $clave;
	private $tipo;
	private $primerNombre;
	private $segundoNombre;
	private $apellidoPaterno;
	private $apellidoMaterno;
	private $imagen;
	
	public function getId() {
		return $this->id;
	}
	
	public function getCorreo() {
		return $this->correo;
	}

	public function getClave() {
		return $this->clave;
	}

	public function getTipo() {
		return $this->tipo;
	}

	public function getPrimerNombre() {
		return $this->primerNombre;
	}

	public function getSegundoNombre() {
		return $this->segundoNombre;
	}

	public function getApellidoPaterno() {
		return $this->apellidoPaterno;
	}

	public function getApellidoMaterno() {
		return $this->apellidoMaterno;
	}

	public function getImagen() {
		return $this->imagen;
	}
	
	public function setId($id) {
		$this->id = $id;
	}

	public function setCorreo($correo) {
		$this->correo = $correo;
	}

	public function setClave($clave) {
		$this->clave = $clave;
	}

	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}

	public function setPrimerNombre($primerNombre) {
		$this->primerNombre = $primerNombre;
	}

	public function setSegundoNombre($segundoNombre) {
		$this->segundoNombre = $segundoNombre;
	}

	public function setApellidoPaterno($apellidoPaterno) {
		$this->apellidoPaterno = $apellidoPaterno;
	}

	public function setApellidoMaterno($apellidoMaterno) {
		$this->apellidoMaterno = $apellidoMaterno;
	}

	public function setImagen($imagen) {
		$this->imagen = $imagen;
	}
}
?>