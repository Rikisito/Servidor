<?php
class Singleton
{
	private static $instances = array(); // nos permitirá almacenar instancias de diferentes clases
	private function __construct() {}
	public function __clone() {
		trigger_error("No puedes clonar un objeto de la clase ". get_called_class(),E_USER_ERROR );
	}
	public function __wakeup()
	{
		trigger_error("No puedes deserializar una instancia de ". get_called_class(),E_USER_ERROR );
	}
	public static function getInstance()
	{
		$cls = get_called_class(); // devuelve el nombre de la clase que ha llamado al método
		if (!isset(self::$instances[$cls])) {
			self::$instances[$cls] = new static; // con new static se instancia la clase que ha llamado al método
		}
		return self::$instances[$cls];
	}
}