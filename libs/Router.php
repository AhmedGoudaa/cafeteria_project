<?php

class Router {

    const DEFAULT_CONTROLLER = "login";
    const DEFAULT_ACTION = "index";

    protected $controller = self::DEFAULT_CONTROLLER;
    protected $action = self::DEFAULT_ACTION;
    protected $params = array();
    protected $basePath = "cafeteria_project/";
    protected $path = "";

    public function __construct(array $options = array()) {

        if (empty($options)) {
            $this->parseUri();
        } else {
            if (isset($options["controller"])) {
                $this->setController($options["controller"]);
            }
            if (isset($options["action"])) {
                $this->setAction($options["action"]);
            }
            if (isset($options["params"])) {
                $this->setParams($options["params"]);
            }
        }
    }

    protected function parseUri() {
        $this->path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
        $this->path = preg_replace('/[^a-zA-Z0-9]\//', "", $this->path);
        if (strpos($this->path, $this->basePath) === 0) {
            $this->path = substr($this->path, strlen($this->basePath));
        }
        @list($controller, $action, $params) = explode("/", $this->path, 3);
        if (isset($controller)) {
            $this->setController($controller);
        }
        if (isset($action)) {
            $this->setAction($action);
        }
        if (isset($params)) {
            $this->setParams(explode("/", $params));
        }
    }

    public function setController($controller) {
//        try {
        if ($controller . "/" == $this->basePath && !empty($_SESSION['user_id'])) {
            if ($_SESSION['type'] == 1) {
                $controller = "orders";
            } else {
                $controller = "userpanel";
            }
        }

        $controller = ucfirst(strtolower($controller)) . "Controller";
        if (!class_exists($controller)) {
//            throw new InvalidArgumentException(
//            "The action controller '$controller' has not been defined.");
//            print_r($cc);die("--");
            $this->controller = "ErrorHandlerController";
            return $this;
        }
//        print_r($controller);
//        die("---");
        $this->controller = $controller;
        return $this;
//        } catch (Exception $e) {
//            $this->controller = "ErrorHandlerController";
//            return $this;
//        }
    }

    public function setAction($action) {
        try {
            $reflector = new ReflectionClass($this->controller);
            if (!$reflector->hasMethod($action)) {
                throw new InvalidArgumentException(
                "The controller action '$action' has been not defined.");
            }
            $this->action = $action;
            return $this;
        } catch (Exception $e) {
            $this->action = "index";
            return $this;
        }
    }

    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }

    public function run() {

//        if (!strpos($this->path, 'static')) {
        if (empty($_SESSION["user_id"]) && !in_array($this->action, array("resetDone", "sendEmail", "resetPassword", "confirmEmail"))) {
            call_user_func_array(array(new LoginController(), "index"), array());
//            header("Location: " . BASE_URL . "login/index");
        } else {
            call_user_func_array(array(new $this->controller, $this->action), $this->params);
        }
//        }
    }

//    public function load() {
//        $this->path = $_GET['q'];
//        $parts = explode('/', $this->path);
//        $controller = $parts[0];
//        if (count($parts) == 2) {
//            $controller->$parts[1];
//        }
//    }
}