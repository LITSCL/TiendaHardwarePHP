<?php 
if (file_exists('config/parameters.php')) {
	require_once 'config/parameters.php'; 
}		
else {
    require_once '../config/parameters.php';
}
?>

<?php 
class DefaultControlador {
	public function renderizarVistaDefault() {
		require_once 'models/dao/ProductoDAO.php';
		require_once 'helpers/PaginadorHelper.php';
		
		$paginadorHelper = new PaginadorHelper("producto", 15);
		
		require_once 'views/default.php';
	}
}
?>