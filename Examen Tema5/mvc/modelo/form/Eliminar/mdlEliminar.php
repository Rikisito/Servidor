<?php

class mdlEliminar extends Singleton {
	const PAGE = 'eliminar';

	public function onGestionPagina() {
		if (getGet('pagina') != self::PAGE) return;

		$_SESSION[self::PAGE]['dni'] = getGet('dni');

		$_SESSION['elim'] = Pacientes::removeDB(getGet('dni'));

		redirectTo('index.php?pagina=mensaje');

	}

	public function onCargarVista($path) {
		if (getGet('pagina') != self::PAGE) return;
		ob_start();
		include $path;
		$vista = ob_get_contents();
		ob_end_clean();
		echo EliminarParser::loadContent($vista);
	}
}

?>
