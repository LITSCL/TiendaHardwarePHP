<?php
class Pedido {
	private $id;
	private $ciudad;
	private $comuna;
	private $calle;
	private $coste;
	private $estado;
	private $fecha;
	private $hora;
	private $usuarioFK;

	public function getId() {
		return $this->id;
	}

	public function getCiudad() {
		return $this->ciudad;
	}

	public function getComuna() {
		return $this->comuna;
	}

	public function getCalle() {
		return $this->calle;
	}

	public function getCoste() {
		return $this->coste;
	}

	public function getEstado() {
		return $this->estado;
	}

	public function getFecha() {
		return $this->fecha;
	}

	public function getHora() {
		return $this->hora;
	}

	public function getUsuarioFK() {
		return $this->usuarioFK;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setCiudad($ciudad) {
		$this->ciudad = $ciudad;
	}

	public function setComuna($comuna) {
		$this->comuna = $comuna;
	}

	public function setCalle($calle) {
		$this->calle = $calle;
	}

	public function setCoste($coste) {
		$this->coste = $coste;
	}

	public function setEstado($estado) {
		$this->estado = $estado;
	}

	public function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	public function setHora($hora) {
		$this->hora = $hora;
	}

	public function setUsuarioFK($usuarioFK) {
		$this->usuarioFK = $usuarioFK;
	}     
}
?>