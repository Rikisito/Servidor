<?php
/**
 * Created by PhpStorm.
 * User: Daw2
 * Date: 15/01/2018
 * Time: 9:41
 */

class EventDispatcher extends Singleton {
    protected $_callbacks = array();
    function registerEventsModels() {
        foreach (get_declared_classes() as $class) {
            if (substr($class, 0, 3) != 'mdl') continue;
            // Events
            $this->registerEventCallback(array($class::getInstance(), 'onGestionPagina'));
            $this->registerEventCallback(array($class::getInstance(), 'onCargarVista'));
        }
    }
    function registerEventCallback($callback) {
        if (!in_array($callback[1], get_class_methods($callback[0])))
            return;
        $this->_callbacks[] = $callback;
    }
    function trigger($fnc, $args = array()) {
        foreach ($this->_callbacks as $callback) {
            if ($callback[1] != $fnc)
                continue;
            call_user_func($callback, $args);
        }
    }
}