<?php
/**
 * Created by PhpStorm.
 * User: Daw2
 * Date: 15/01/2018
 * Time: 9:40
 */
class Conexion extends Singleton {
    private $_pdo;
    public function openConnection ($options) {
        try {
            $dsn = $options['database_type'] . ':host=' . $options['server'] . ';port=' .
                $options['port'] . ';dbname=' . $options['database_name'];
            $password = $options['password'];
            $option = $options['option'];
            $username = $options['username'];
            $this->_pdo = new PDO(
                $dsn,
                $username,
                $password,
                $option
            );
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_pdo->exec("SET NAMES '".$options['charset']."'");
        }
        catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function closeConnection () {
        $this->_pdo = NULL;
    }
    public function getPdo() {
        return $this->_pdo;
    }
}
