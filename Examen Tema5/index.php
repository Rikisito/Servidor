<?php
require_once "include.php";
Session::startSession();
// Siempre se eliminan los datos de la sesión cuando la aplicación se ejecuta desde el principio
// para evitar que pueda visualizarse la página del paso2 (modicando el valor de pagina en la url) con
// datos erróneos si previamente se han almacenado datos válidos en la sesión en una ejecución previa
if (is_null(getGet('pagina')))
    Session::closeSession();
Controlador::init();
