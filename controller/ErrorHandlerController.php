<?php

class ErrorHandlerController {

    public function index() {
        $template = new Template();
        $template->render("error_handler/index.php");
    }

}
