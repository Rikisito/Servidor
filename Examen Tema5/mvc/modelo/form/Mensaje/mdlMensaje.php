<?php
class mdlMensaje extends Singleton {
	const PAGE = 'mensaje';
	public function onGestionPagina() {
		if (getGet('pagina') != self::PAGE) return;
		if (!isset($_SESSION['modificar']) && !isset($_SESSION['ingresar']) && !isset($_SESSION['eliminar'])) {
			redirectTo('index.php');
		}
	}
	public function onCargarVista($path) {
		if (getGet('pagina') != self::PAGE) return;
		ob_start();
		include $path;
		$vista = ob_get_contents();
		ob_end_clean();
		echo MensajeParser::loadContent($vista);
	}
}
?>
