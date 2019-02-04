<?php

class mdlModificar extends Singleton {
	const PAGE = 'modificar';

	public function onGestionPagina() {
		if (getGet('pagina') != self::PAGE) return;


		if (!is_null(getPost('buscar'))) {
			if (is_null(getPost('modificar'))) {
				$_SESSION['dniBuscar'] = getPost('dniBuscar');
				$_SESSION['paciente'] = Pacientes::searchDniDB(getPost('dniBuscar'));
				$datosPaciente = $_SESSION['paciente'];

				if (count($datosPaciente) > 0) {
					// Utilizamos la validación para rellenar los campos del formulario.
					$val = Validacion::getInstance();
					$toValidate = $datosPaciente[0];
					$rules = array(
						'nombre' => 'required|alpha_space_30',
						'apellidos' => 'required|alpha_space_30',
						'dni' => 'required|duplicate|dni',
						'historial' => 'required|alpha_space_50'
					);
					$val->addRules($rules);
					$val->run($toValidate);
				} else {
					redirectTo('index.php?pagina=modificar');
				}
			}

		} else {

			if (!is_null(getPost('modificar'))) {


				$val = Validacion::getInstance();
				$toValidate = $_POST;
				$rules = array(
					'nombre' => 'required|alpha_space_30',
					'apellidos' => 'required|alpha_space_30',
					'dni' => 'required|duplicate|dni',
					'historial' => 'required|alpha_space_50'
				);

				if (Pacientes::duplicateDNI(getPost('dni'),$_SESSION['paciente'][0]['id'])){
					$val->setExists(true);
				}


				$val->addRules($rules);
				$val->run($toValidate);
				if ($val->isValid()) {
					$_SESSION[self::PAGE] = $val->getOks();

					$datos = Pacientes::modifyDB($_SESSION['dniBuscar'], $_SESSION[self::PAGE]);
					if ($datos)
						$_SESSION['mod'] = true;
					else
						$_SESSION['mod'] = false;
					redirectTo('index.php?pagina=mensaje');
				}


			}



		}


//// Validamos
//		$val = Validacion::getInstance();
//// Validamos los elementos que hay en $_POST
//		$toValidate = ($_POST);
//		$rules = array(
//			'dni' => 'required|dni'
//		);
//		$val->addRules($rules);
//		$val->run($toValidate);
//		if (!is_null(getPost(self::PAGE))) {
//			if ($val->isValid()) {
//
//				$_SESSION[self::PAGE] = $val->getOks();
//
//				redirectTo('index.php?pagina=mensaje');
//			}
//		}


	}

	public function onCargarVista($path) {
		if (getGet('pagina') != self::PAGE) return;
		ob_start();
		include $path;
		$vista = ob_get_contents();
		ob_end_clean();
		echo ModificarParser::loadContent($vista);
	}
}

?>
