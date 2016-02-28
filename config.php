<?php

define("DB_NAME","cafeteria");
define("DB_USER",getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
define("DB_PASSWORD",getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));

define("DB_SERVER",getenv('OPENSHIFT_MYSQL_DB_HOST'));
define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 


define("APP_PATH",realpath(__DIR__));
define("CSS_PATH",__DIR__."/static/css/bootstrap/css/bootstrap.min.css");
define("BASE_URL","https://blog-testphpproject.rhcloud.com/");

define("PS",PATH_SEPARATOR);
define("CONTROLLER_DIR",APP_PATH."/controller/");
define("MODEL_DIR",APP_PATH."/model/");
define("TEMPLATE_DIR",APP_PATH."/template/");
define("LIBS_DIR",APP_PATH."/libs/");
//$baseURL = "localhost/project";
