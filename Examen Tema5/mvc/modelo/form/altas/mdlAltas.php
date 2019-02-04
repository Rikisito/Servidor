<?php
class mdlAltas extends Singleton {
	const PAGE = 'altas';
	public function onGestionPagina() {
		if (getGet('pagina') != self::PAGE) return;
// Validamos
		$val = Validacion::getInstance();
// Validamos los elementos que hay en $_POST
		$toValidate = ($_POST);
		$rules = array(
			'buscar' => 'required',
		);
		$val->addRules($rules);
		$val->run($toValidate);


		if (!is_null(getPost(self::PAGE))) {
			if ($val->isValid()) {

				$_SESSION[self::PAGE] = $val->getOks();
				$_SESSION[self::PAGE] = Pacientes::searchDniNombreApellidos($_SESSION[self::PAGE]['buscar']);

				$_SESSION['alta'] = true;

				redirectTo('index.php?pagina=altas');
			}
		}
	}
	public function onCargarVista($path) {
		if (getGet('pagina') != self::PAGE) return;
		ob_start();
		include $path;
		$vista = ob_get_contents();
		ob_end_clean();
		echo AltasParser::loadContent($vista);
	}
}