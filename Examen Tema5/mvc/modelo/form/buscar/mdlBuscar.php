<?php
class mdlBuscar extends Singleton {
	const PAGE = 'buscar';
	public function onGestionPagina() {
		if (getGet('pagina') != self::PAGE) return;
// Validamos
		$val = Validacion::getInstance();
// Validamos los elementos que hay en $_POST
		$toValidate = ($_POST);
		$rules = array(
			'campoBuscar' => 'required',
		);
		$val->addRules($rules);
		$val->run($toValidate);


		if (!is_null(getPost(self::PAGE))) {
			if ($val->isValid()) {

				$_SESSION[self::PAGE] = $val->getOks();
				$_SESSION[self::PAGE] = Pacientes::searchDniNombreApellidos($_SESSION[self::PAGE]['campoBuscar']);

				$_SESSION['busqueda'] = true;

				redirectTo('index.php?pagina=buscar');
			}
		}
	}
	public function onCargarVista($path) {
		if (getGet('pagina') != self::PAGE) return;
		ob_start();
		include $path;
		$vista = ob_get_contents();
		ob_end_clean();
		echo BuscarParser::loadContent($vista);
	}
}