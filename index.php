<?php

ini_set('display_errors', 1);
session_start();
include('config.php');
set_include_path(get_include_path() . PS . CONTROLLER_DIR . PATH_SEPARATOR . MODEL_DIR . PS . TEMPLATE_DIR . PS . LIBS_DIR);
function autoload($class) {
    @include ($class . ".php");
}
spl_autoload_register("autoload");
$conn = Connection::startConnection()->conn;
//echo json_encode(array("status" => "success"));
$router = new Router();
$router->run();
