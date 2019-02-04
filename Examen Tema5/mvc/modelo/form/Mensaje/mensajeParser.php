<?php

class MensajeParser {
	public static function loadContent($vista) {
		$vista = self::_pasoSiguiente($vista);
		return $vista;
	}

	private static function _pasoSiguiente($vista) {
		foreach (getTagsVista($vista) as $tag) {
// sustituimos en el formulario los tags por el contenido de los elementos del formulario
			$str = '';
			switch ($tag) {
				case 'mensaje':

					if (isset($_SESSION['ingresar']) && $_SESSION['ing']) {
						$str = "El ingreso se ha realizado Correctamente";
					}
					if (isset($_SESSION['eliminar']) && $_SESSION['elim']) {
						$str = "Paciente dado de alta correctamente";
					}
					if (isset($_SESSION['modificar']) && $_SESSION['mod']) {
						$str = "Paciente modificado correctamente";
					}


					break;
			}
			$vista = str_replace('{{' . $tag . '}}', $str, $vista);
		}
		return $vista;
	}
}

?>
