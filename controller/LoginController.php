<?php

class LoginController {

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $template = new Template();
            $template->render("login/index.php");
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
            
        }
    }

}
