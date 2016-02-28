<?php

class Template {

    public $template_parts = array('header.php', 'body.php', 'footer.php');

    function render($view, $data = array()) {
        foreach ($this->template_parts as $part) {
            include $part;
        }
    }

}
