<?php

class Pacientes {


	public static function duplicateDNI($dni, $id = null) {
		$database = medoo::getInstance();
		$database->openConnection(MYSQL_CONFIG);
		$datos = ($database->count('pacientes', ["AND" => ['dni' => $dni, 'id[!]' => $id]]) > 0) ? true : false;
		$database->closeConnection();
		return $datos;
	}


	public static function searchDniDB($dni) {
		$database = Medoo::getInstance();
		$database->openConnection(MYSQL_CONFIG);
		$datos = $database->select("pacientes", "*", ["dni[=]" => $dni]);
		$database->closeConnection();
		return $datos;
	}


	public static function modifyDB($dni, $data) {
		$database = Medoo::getInstance();
		$database->openConnection(MYSQL_CONFIG);
		$datos = $database->update("pacientes", $data, ["dni[=]" => $dni]);
		$database->closeConnection();
		return $datos;
	}

	public static function removeDB($dni) {
		$database = medoo::getInstance();
		$database->openConnection(MYSQL_CONFIG);
		$datos = $database->delete('pacientes', ["dni[=]" => $dni]);
		$datos = $datos->rowCount() > 0 ? true : false; //medoo devuelve un objeto statement
		$database->closeConnection();
		return $datos;
	}

	public static function searchDniNombreApellidos($buscar) {
		$database = Medoo::getInstance();
		$database->openConnection(MYSQL_CONFIG);
//		$datos = $database->select("pacientes","*",["apellidos[=]" => $buscar]);
		$datos = $database->select("pacientes", ["dni", "nombre", "apellidos", "historial", "fecha_ingreso"], ["OR" => ["dni[=]" => $buscar, "nombre[=]" => $buscar, "apellidos[=]" => $buscar]]);
		$database->closeConnection();
		return $datos;
	}

	public static function searchAllDB() {
		$database = Medoo::getInstance();
		$database->openConnection(MYSQL_CONFIG);
		$datos = $database->select("pacientes", ["dni", "nombre", "apellidos", "historial", "fecha_ingreso"]);
		$database->closeConnection();
		return $datos;
	}

	public static function insertDB($data) {
		$database = Medoo::getInstance();
		$database->openConnection(MYSQL_CONFIG);
		$datos = $database->insert("pacientes", $data);
		$database->closeConnection();
		return $datos;
	}

}