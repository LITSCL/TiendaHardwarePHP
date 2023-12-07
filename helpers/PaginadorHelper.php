<?php require_once 'config/parameters.php'; ?>

<?php
class PaginadorHelper extends Database {
	protected $db;
	private $nombreTabla;
	private $condicion;
	private $nombreParametro;
	private $valorParametro;
	private $paginaActual;
	private $totalPaginas;
	private $totalResultados;
	private $resultadosPorPagina;
	private $indice;
	private $error = false;
    
   	function __construct($nombreTabla, $resultadosPorPagina, $condicion = false, $nombreParametro = false, $valorParametro = false) {
		$this->db = Database::conectar();
		$this->nombreTabla = $nombreTabla;
		($condicion != false) ? $this->condicion = $condicion : false;
		($nombreParametro != false) ? $this->nombreParametro = $nombreParametro : false;
		($valorParametro != false) ? $this->valorParametro = $valorParametro : false;
		$this->resultadosPorPagina = $resultadosPorPagina;
		$this->indice = 0;
		$this->paginaActual = 1;
		$this->calcularPaginas();
	}
    
	function calcularPaginas() {
		if ($this->condicion == false) {
			$query = $this->db->query("SELECT COUNT(*) AS total FROM {$this->nombreTabla}");
		}
		else {
			$query = $this->db->query("SELECT COUNT(*) AS total FROM {$this->nombreTabla} {$this->condicion}");
		}	

		$this->totalResultados = $query->fetch_object()->total;
		$this->totalPaginas = ceil($this->totalResultados / $this->resultadosPorPagina);
        
		if (isset($_GET["pagina"])) {
			if (is_numeric($_GET["pagina"])) { 
				if ($_GET["pagina"] >= 1 && $_GET["pagina"] <= $this->totalPaginas) { 
					$this->paginaActual = $_GET["pagina"];
					$this->indice = ($this->paginaActual - 1) * ($this->resultadosPorPagina);
				}
				else {
					$this->error = true;
				}
			}
			else {
				$this->error = true;
				return false;
			}
		}
	}
    
	function mostrarDatos($formato, $nombreInclude, $columnas = false, $pagina = false) {
		if ($this->error == false) {
			if ($this->condicion == false) {
				$query = $this->db->query("SELECT {$this->nombreTabla}.* FROM {$this->nombreTabla} LIMIT {$this->indice}, {$this->resultadosPorPagina}");
			}
			else {
				$query = $this->db->query("SELECT {$this->nombreTabla}.* FROM {$this->nombreTabla} {$this->condicion} LIMIT {$this->indice}, {$this->resultadosPorPagina}");
			}
    		
			if ($query->num_rows > 0) {
				if ($formato == "tarjeta") {
					while ($objeto = $query->fetch_object()) {
						include "views/includes/$nombreInclude.php";
					}
				}
    			
				if ($formato == "tabla") {
					echo "<table class='tabla'>";
					echo "<tr>";
					for ($i = 0; $i < count($columnas); $i++) {
						echo "<th>" . $columnas[$i] . "</th>";
					}
					echo "</tr>";
					while ($objeto = $query->fetch_object()) {
						include "views/includes/$nombreInclude.php";
					}
					echo "</table>";
				}
				return true;
			}
			else {
				return "Sin Registros";
			}
		}
		return "Pagina Inexistente";
	}
    
	function mostrarPaginas($ruta = false) {
		if ($this->error == false) {
			$actual = ""; 
			echo "<ul>";
			for ($i = 0; $i < $this->totalPaginas; $i++) { 
				if ($i + 1 == $this->paginaActual) { 
					$actual = "class='actual'";
				}
				else {
					$actual = "";
				}
				if ($ruta != false) {
					if ($this->nombreParametro != false && $this->valorParametro != false) {
						echo "<li>" . "<a $actual href='" . $ruta . "&$this->nombreParametro=" . $this->valorParametro . "&pagina=" . ($i + 1) . "'>" . ($i + 1) . "</a></li>";
					}
					else {
						echo "<li>" . "<a $actual href='" . $ruta . "&pagina=" . ($i + 1) . "'>" . ($i + 1) . "</a></li>";
					}            	
				}
				else {
					echo "<li>" . "<a $actual href='" . "?pagina=" . ($i + 1) . "'>" . ($i + 1) . "</a></li>";
				} 
			}
			echo "</ul>";
		}
	}
}
?>