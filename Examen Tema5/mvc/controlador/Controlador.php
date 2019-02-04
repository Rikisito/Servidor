<?php
/**
 * Created by PhpStorm.
 * User: Daw2
 * Date: 15/01/2018
 * Time: 9:41
 */
class Controlador {
    public static function init() {
        $page = getGet('pagina');
        if ($page == null) redirectTo('index.php?pagina='.VISTA_PORDEFECTO);
        // Preparación
        EventDispatcher::getInstance()->registerEventsModels();
        // Workflow
        self::_gestionPagina();
        self::_cargarVista();
    }
    private static function _gestionPagina() {
        EventDispatcher::getInstance()->trigger('onGestionPagina');
    }
    private static function _cargarVista() {
        $path = VISTAS_PATH.getGet('pagina').'.php';
        EventDispatcher::getInstance()->trigger('onCargarVista', $path);
    }
}
