<?php
class InicioParser {
	public static function loadContent($vista) {
		$vista = self::_pasoSiguiente($vista);
		return $vista;
	}
	private static function _pasoSiguiente($vista) {
		foreach (getTagsVista($vista) as $tag) {
// sustituimos en el formulario los tags por el contenido de los elementos del formulario
			$str = '';
			$info= $_SESSION['info'];
			foreach (getTagsVista($vista) as $tag) {
				$str = '';
				switch ($tag) {
					case 'register':
						if ($info == 'nologged')
							$str = "<li><a href=\"index.php\">Pagina Login</a></li><li><a href=\"index.php?pagina=registro\">Registrarse</a></li>";
						break;
					case 'msg':
						switch ($info) {
							case 'logged':
								$str = 'Validación realizada correctamente';
								Session::del('info'); // No permitimos ir al registro desde aqui
								break;
							case 'nologged':
								$str = 'No existe el usuario';
								break;
							case 'registed':
								$str = 'Usuario guardado';
								Session::del('info'); // No permitimos ir al registro desde aqui
								break;
							case 'noRegisted':
								$str = 'El usuario no se ha podido guardar';
								Session::del('info'); // No permitimos ir al registro desde aqui
								break;
						}
						break;
				}
				$vista = str_replace('{{' . $tag . '}}', $str, $vista);
			}
			return $vista;
		}
	}
}