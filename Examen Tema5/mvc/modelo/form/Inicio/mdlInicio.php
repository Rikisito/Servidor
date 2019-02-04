<?php
/**
 * Created by PhpStorm.
 * User: Daw2
 * Date: 15/01/2018
 * Time: 9:43
 */
class mdlInicio extends Singleton {
	const PAGE = 'inicio';
	public function onGestionPagina() {
		if (self::PAGE != getGet('pagina', 'menu')) return;
	}
	public function onCargarVista($path) {
		if (self::PAGE != getGet('pagina', 'menu')) return;
		ob_start();
		include $path;
		$vista = ob_get_contents();
		ob_end_clean();
		echo $vista;
	}
}
