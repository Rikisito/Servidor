<?php
class Session {
	/**
	 * startSession: Gestiona el inicio de sesion.
	 */
	public static function startSession() {
// Retorna null si las sesiones no están habilitadas o hay una sesión iniciada
		if (session_status() != PHP_SESSION_NONE)
			return;
		session_start();
	}
	/**
	 * closeSession: Gestiona el cerrado y borrado de los datos de la sesión del navegador
	 */
	public static function closeSession() {
		if (isset($_COOKIE[session_name()])) {
			setcookie(session_name(), "", time() - 3600, "/");
		}
		session_unset();
		session_destroy();
	}
	/**
	 * get: Devuelve el valor o en su defecto el valor que quiera el usuario si no existe
	 *
	 * @param $index
	 * @param null $else
	 * @return null
	 */
	public static function get($index, $else = null) {
		return (isset($_SESSION[$index])) ? $_SESSION[$index] : $else;
	}
	/**
	 * del: Elimina un elemento de $_SESSION
	 *
	 * @param $index
	 */
	public static function del($index) {
		if (array_key_exists($index, $_SESSION)) unset($_SESSION[$index]);
	}
}