<?php

class mdlIngresar extends Singleton {
	const PAGE = 'ingresar';

	public function onGestionPagina() {
		if (getGet('pagina') != self::PAGE) return;
// Validamos
		$val = Validacion::getInstance();
// Validamos los elementos que hay en $_POST
		$toValidate = ($_POST);
		$rules = array(
			'nombre' => 'required|alpha_space_30',
			'apellidos' => 'required|alpha_space_30',
			'dni' => 'required|dni|duplicate',
			'historial' => 'required|alpha_space_50'
		);

		if (Pacientes::duplicateDNI(getPost('dni'))){
			$val->setExists(true);
		}


		$val->addRules($rules);
		$val->run($toValidate);
		if (!is_null(getPost(self::PAGE))) {
			if ($val->isValid()) {
// Guardamos los datos en session
				$_SESSION[self::PAGE] = $val->getOks();
				$datos = Pacientes::insertDB($_SESSION[self::PAGE]);
				if ($datos)
					$_SESSION['ing'] = true;
				else
					$_SESSION['ing'] = false;
// Cambiamos el paso
				redirectTo('index.php?pagina=mensaje');

			}
		}
	}

	public function onCargarVista($path) {
		if (getGet('pagina') != self::PAGE) return;
		ob_start();
		include $path;
		$vista = ob_get_contents();
		ob_end_clean();
		echo IngresarParser::loadContent($vista);
	}
}