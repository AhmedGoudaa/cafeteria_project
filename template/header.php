<html>
    <head>
        <title>Cafeteria</title>
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/static/css/bootstrap/css/bootstrap.min.css" />
        <script type="text/javascript" src="<?= BASE_URL ?>/static/js/jquery-min.js"></script>
        <script type="text/javascript" src="<?= BASE_URL ?>/static/css/bootstrap/js/bootstrap.min.js"></script>
        <style>
            span.errorMsg {
                color: red;
            }
            label{
                font: italic bold 15px Georgia, serif;
            }
            /*File Input Styling*/
            .btn-file {
                position: relative;
                overflow: hidden;
            }
            .btn-file input[type=file] {
                position: absolute;
                top: 0;
                right: 0;
                min-width: 100%;
                min-height: 100%;
                font-size: 100px;
                text-align: right;
                filter: alpha(opacity=0);
                opacity: 0;
                outline: none;
                background: white;
                cursor: inherit;
                display: block;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <header class="row header">
                <nav class="navbar navbar-default " style='background-color:dodgerblue;padding-right: 20px'>
                    <div class="navbar-header">
                        <button class='btn navbar-toggle' data-toggle='collapse' data-target='#my-nav'>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                        </button>
                        <a class="navbar-brand" href="#"><i class="glyphicon glyphicon-home"></i>GemyCafe</a>
                    </div>
                    <ul class="nav navbar-nav collapse navbar-collapse" id='my-nav'>
                        <li><a href="#">Home</a></li>
                        <li><a href="<?= BASE_URL ?>product/index">Products</a></li>
                        <li><a href="<?= BASE_URL ?>user/index">Users</a></li>
                        <li><a href="#">Manual Order</a></li>
                        <li><a href="#">Checks</a></li>
                    </ul>
                    <div>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?= BASE_URL ?>login/index"><i class="glyphicon glyphicon-user"></i> Sign Up</a></li>
                            <li><a href="<?= BASE_URL ?>login/index"><i class="glyphicon glyphicon-log-in"></i> Login</a></li>
                        </ul>
                    </div>
                </nav>
            </header>