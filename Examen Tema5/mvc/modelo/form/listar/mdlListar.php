<?php
class mdlListar extends Singleton {
	const PAGE = 'listar';
	public function onGestionPagina() {
		if (getGet('pagina') != self::PAGE) return;
// Si no ha pasado por el paso Busqueda (si se modifica el valor de la variable en la url), se vuelve a visualizar la página inicial
//		if (!isset($_SESSION['busqueda'])) {
			$_SESSION['listar'] = Pacientes::searchAllDB();
//		}
	}
	public function onCargarVista($path) {
		if (getGet('pagina') != self::PAGE) return;
		ob_start();
		include $path;
		$vista = ob_get_contents();
		ob_end_clean();
		echo ListarParser::loadContent($vista);
	}
}