<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<?php

class validacion extends singleton
{

	private $_exists;

    private $_rules = array(); // _rules['nombre'] => 'required|alpha_space', _rules['edad'] => 'required|number'
    private $_errors = array(); // _errors['nombre'] = array('value' => '','rule' => 'required') o _errors['nombre'] = array('value' => 'Pedro5','rule' => 'alpha_space') o _errors['nombre'] = array('value' => 'Pedro','rule' => 'ok')
    private $_oks = array(); // _oks['nombre'] =>'Luis', _oks['apellidos'] => "Sánchez Ruiz"
    private $_errorFoto;

    public function addRules($rules)
    {
        $this->_rules = $rules;
    }

    public function run($toValidate)
    {
        foreach ($toValidate as $field => $value) {
// si el nombre del campo no está como índice en $this->_rules, no hay que validarlo
            if (!array_key_exists($field, $this->_rules))
                continue;
// creamos un array con la cadena $this->_rules[$field] usando como separador de elementos |
            $rules = explode('|', $this->_rules[$field]);
// Si el campo es requerido en $rules hay un elemento cuyo contenido es 'required'
            if (in_array('required', $rules)) {
// el método validate_required verifica si el campo tiene contenido, es decir, ha sido rellenado
// si no es así, añade el campo al array _errors
                $this->_validate_required($field, $value);
// si el campo no se ha rellenado no sigue relizando el control de entrada
// por ello verifica que si existe un elemento con el 'rule'='required'
// getArray() esta definida en common.php
                if (getArray($this->getErrorsByField($field), 'rule') == 'required')
                    continue;
            }
            foreach ($rules as $rule) {
                if ($rule == 'required')
                    continue;
                $method = '_validate_' . $rule;
// verifica si el método de validación existe en esta clase (constante __CLASS__)
// la constante __CLASS__ almacena la clase que se está ejecutando en este momento
                if (!method_exists(__CLASS__, $method))
                    continue;
// ejecuta el método de validación (por ejemplo, validate_alpha_space)
                $this->$method($field, $value);
            }
// puede que en los formularios haya algún campo que no queramos validar,
// pero hay que registrarle en _errors para que el método mdlPaso1() recupere su valor
            if (empty($this->getErrorsByField($field)))
                $this->_setError($field, $value, 'ok');
        }
    }

    public function isValid()
    {
        if (count($this->_oks) == count($this->_errors))
            return true;
        return false;
    }

    public function getStrRule($rule)
    {
        switch ($rule) {
// solo hay una posible coincidencia, pero ya añadiremeos más
            case 'alpha_space':
                return 'Solo puede contener letras (a-z) y espacios en blanco';
            case 'numeric':
                return 'Solo puede contener 7 dígitos';
            case 'email':
                return 'No has introducido bien el email' . '';
			case 'duplicate':
				return 'DNI duplicado';
			case 'dni':
				return 'DNI 8 numeros y una letra';
            case 'alpha_space_50':
                return 'Solo admite hasta 50 caracteres';
            case 'foto' :
                return $this->_errorFoto;
            case 'alpha_space_30':
                return 'Solo admite hasta 30 caracteres';
        }
        return '';
    }

    public function restoreValue($name)
    {
        if (array_key_exists($name, $this->_errors)) {
            $value = $this->_errors[$name]['value'];
            return $value;
        }
        return '';
    }

    public function restoreCheckboxes($name, $value, $default = false)
    {
        if ($this->_errors) {
            if (array_key_exists($name, $this->_errors)) {
//si no se marca ninguna casilla, _errors[$name]['value'] no existe
                if ($this->_errors[$name]['value'])
                    foreach ($this->_errors[$name]['value'] as $valor) {
                        if ($valor == $value)
                            return 'checked';
                    }
            }
// si el nombre del campo no está en _errors, es que es la primera vez que se visualiza el formulario
// y es cuando podemos poner valores por defecto.
        } elseif ($default)
            return 'checked';
    }

////*****************************ESTE RESTORE SELECT ES PARA VISTAS MULTIPLES//**************************************************
    public function restoreSelect($name, $value, $default = false)
    {
        if (array_key_exists($name, $this->_errors)) {
            if ($this->_errors[$name]['value'] == $value) {
                return 'selected';
            }
// si el nombre del campo no está en _errors, es que es la primera vez que se visualiza el formulario
// y es cuando podemos poner valores por defecto.
        } elseif ($default)
            return 'selected';
        return '';
    }

    ////*****************************ESTE RESTORE SELECT ES PARA VISSTAS INDIVIDUALES//**************************************************
    public function restoreSelectInd($name, $value, $default = false)
    {
        if (array_key_exists($name, $this->_errors)) {
            if ($this->_errors[$name]['value'] == $value)
                return 'selected';
// si el nombre del campo no está en _radios, es que es la primera vez que se visualiza el formulario
// y es cuando podemos poner valores por defecto.
        } elseif ($default)
            return 'selected';
        return '';
    }

    public function getOks()
    {
        return $this->_oks;
    }

    public function restoreRadios($name, $value, $default = false)
    {
        if (array_key_exists($name, $this->_errors)) {
            if ($this->_errors[$name]['value'] == $value)
                return 'checked';
// si el nombre del campo no está en _radios, es que es la primera vez que se visualiza el formulario
// y es cuando podemos poner valores por defecto.
        } elseif ($default)
            return 'checked';
        return '';
    }

// método que devuelve el elemento del array _errors de un campo (si existe)
    public function getErrorsByField($field)
    {
        return getArray($this->_errors, $field, array());
    }

    public function getErrors()
    {
        return $this->_errors;
    }

    private function _setError($field, $value, $rule)
    {
        $this->_errors[$field] = array(
            'value' => $value,
            'rule' => $rule
        );
        if ($rule == 'ok') {
            $this->_oks[$field] = $value;
        }
    }

// Método que valida que el dato introducido en el campo es correcto
// Observa que la 2ª parte del nombre del método (alpha_space) coincide con el tipo de dato
// que se utiliza en el array $_rules de la clase mdlPaso1
	private function _validate_alpha_space_30($field, $value)
	{
		if (!preg_match('/^[a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ][a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ\s]{1,30}$/i', $value))
			$this->_setError($field, $value, 'alpha_space_30');
	}

    private function _validate_numeric($field, $value)
    {
        if (!preg_match('/^[0-9]{1,4}$/i', $value))
            $this->_setError($field, $value, 'numeric');
    }

// método que añade una elemento al array _errors cuando un campo obligatorio no se ha completado
    private function _validate_required($field, $value)
    {
        $valor = $value;
        if (is_array($value)) {
            $valor = implode(',', $value);
        }
        if (strlen($valor) == 0)
            $this->_setError($field, $value, 'required');
    }

    /*validad hotmail*/
    private function _validate_email($field, $value)
    {
        if (!preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $value))
            $this->_setError($field, $value, 'email');
    }

    /*validad foto*/
    private function _validate_foto($field, $value)
    {
        if ($value["error"] == UPLOAD_ERR_OK) {
            if (($value["type"] != "image/pjpeg") and ($value["type"] != "image/jpeg")) {
                $this->_setError($field, $value, 'foto');
                $this->_errorFoto = "<b>JPEG fotos solamente, gracias!</b>";
            } elseif (!move_uploaded_file($value["tmp_name"], "fotos/" . basename($value["name"]))) {
                $this->_setError($field, $value, 'foto');
                $this->_errorFoto = "<b>Lo sentimos, hubo un problema al subir esa foto</b>" . $value["error"];
            } else
                $this->_setError($field, $value, 'ok');
        } else {
            $this->_setError($field, $value, 'foto');
            switch ($value["error"]) {
                case UPLOAD_ERR_INI_SIZE:
                    $this->_errorFoto = "<b>La foto es más grande de lo que permite el servidor.<b>";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $this->_errorFoto = "<b>La foto es más grande de lo que permite el formulario.<b>";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $this->_setError($field, $value, 'required');
                    break;
                default:
                    $this->_errorFoto = "Ponte en contacto con el administrador del servidor para obtener ayuda.";
            }
        }
    }

	public function setExists($dup) {
		$this->_exists = $dup;
	}

	private function _validate_duplicate($field, $value) {
		if ($this->_exists)
			$this->_setError($field, $value, 'duplicate');
	}

	private function _validate_dni($field, $value) {
		if (!preg_match('/^\d{8}[a-zA-Z]$/', $value))
			$this->_setError($field, $value, 'dni');
	}

	private function _validate_alpha_space_50($field, $value) {
		if (!preg_match('/^[a-z][a-z\s]{1,50}$/i', $value))
			$this->_setError($field, $value, 'alpha_space_50');
	}


}
