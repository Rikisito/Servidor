<?php

class ListarParser {
	public static function loadContent($vista) {
		$vista = self::_pasoSiguiente($vista);
		return $vista;
	}

	private static function _pasoSiguiente($vista) {
		foreach (getTagsVista($vista) as $tag) {
// sustituimos en el formulario los tags por el contenido de los elementos del formulario
			$str = '';
			switch ($tag) {
				case 'lista':
					$datos = $_SESSION['listar'];
					if (count($datos) > 0) {
						$str = "<table><tr>";
						foreach ($datos[0] as $field => $value) {
							$str .= "<th>$field</th>";
						}
						$str .= "</tr>";
						foreach ($datos as $producto) {
							$str .= "<tr>";
							foreach ($producto as $value)
								$str .= "<td>" . $value . "</td>";
							$str .= "</tr>";
						}

						$str.="</table>";

					} else
						$str = '<p> <b>No se han encontrado resultados...</b></p>';
					break;
			}
			$vista = str_replace('{{' . $tag . '}}', $str, $vista);
		}
		return $vista;
	}
}