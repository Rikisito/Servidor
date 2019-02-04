<?php

class AltasParser {
	public static function loadContent($vista) {
		$vista = self::pasoSiguiente($vista);
		return $vista;
	}

	public static function pasoSiguiente($vista) {
		$val = Validacion::getInstance();
		$required_fields = '';
		$warning_fields = '';
		foreach ($val->getErrors() as $field => $error) {
			$value = $error['value'];
			$rule = $error['rule'];
			switch ($rule) {
				case 'ok':
					$vista = str_replace('{{class-' . $field . '}}', '', $vista);
					break;
				case 'required':
					$required_fields .= "<strong>$field</strong>, ";
					$vista = str_replace('{{class-' . $field . '}}', 'has-error', $vista);
					break;
				case 'integer':
					$warning_fields .= "<strong>$field</strong>, ";
					$vista = str_replace('{{class-' . $field . '}}', 'has-warning', $vista);
					$vista = str_replace('{{war-' . $field . '}}', $val->getStrRule($rule), $vista);
					break;
			}
		}
		foreach (getTagsVista($vista) as $tag) {
			$str = '';
			switch ($tag) {
				case "errores":
					if (strlen($required_fields) > 0) {
						$required_fields = substr($required_fields, 0, -2);
						$str .= "<p class='has-error'> El/Los campo(s) $required_fields son obligatorios</p>";
					}
					if (strlen($warning_fields) > 0) {
						$warning_fields = substr($warning_fields, 0, -2);
						$str .= "<p class='has-warning'> El/Los campo(s) $warning_fields tienen errores de formato.</p>";
					}
					break;
				case 'resultadoAltas':

					if (isset($_SESSION['altas']) && $_SESSION['alta'] == true){
						$datos = $_SESSION['altas'];
						if (count($datos) > 0) {
							$str = "<table><tr>";
							foreach ($datos[0] as $field => $value) {
								$str .= "<th>$field</th>";
							}
							$str .= "</tr>";
							foreach ($datos as $producto) {
								$str .= "<tr>";
								foreach ($producto as $value){
									$str .= "<td>" . $value . "</td>";
								}
								$str .= "<td><a href='index.php?pagina=eliminar&dni=".$producto['dni']."'>Dar Alta</a></td>";
								$str .= "</tr>";


								$_SESSION['alta'] = false;

							}

							$str .= "</table>";

							$_SESSION['alta'] = false;

						} else {
							$str = '<p> <b>No se han encontrado resultados...</b></p>';
						}
					}




					break;
			}
			$vista = str_replace('{{' . $tag . '}}', $str, $vista);
		}
		return $vista;
	}
}