<html>
    <head>
        <title>Cafeteria</title>
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/static/css/bootstrap/css/bootstrap.min.css" />
<<<<<<< HEAD
        <script type="text/javascript" src="<?= BASE_URL ?>/static/js/jquery-min.js"></script>
        <script type="text/javascript" src="<?= BASE_URL ?>/static/css/bootstrap/js/bootstrap.min.js"></script>
	   <script type="text/javascript" src="<?= BASE_URL ?>/static/js/jquery-ui-timepicker-addon.js"></script>
     <script type="text/javascript" src="<?= BASE_URL ?>/static/js/datetimepicker_css.js"></script>s
=======
       
        <script type="text/javascript" src="<?= BASE_URL ?>/static/js/jquery-min.js"></script>
        <script type="text/javascript" src="<?= BASE_URL ?>/static/css/bootstrap/js/bootstrap.min.js"></script>

         <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/static/css/bootstrap/css/style.css" />
>>>>>>> 449837dcd592cd5f3c6413ea3cac809ea9d4af5f
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
<<<<<<< HEAD
        <div class="container-fluid">
            <header class="row header">
                <nav class="navbar navbar-default " style='background-color:dodgerblue;padding-right: 20px'>
=======
        <div id="wrapper" class="container-fluid">
            <header  class="row header">
                <nav id="header" class="navbar navbar-default " style='background: url("<?= BASE_URL ?>static/img/banner2.jpg") no-repeat;padding-right: 20px'>
>>>>>>> 449837dcd592cd5f3c6413ea3cac809ea9d4af5f
                    <div class="navbar-header">
                        <button class='btn navbar-toggle' data-toggle='collapse' data-target='#my-nav'>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                        </button>
<<<<<<< HEAD
                        <a class="navbar-brand" href="#"><i class="glyphicon glyphicon-home"></i>GemyCafe</a>
=======
                        <a  class="navbar-brand" href="#"><img width="100px" height="60px" src="<?= BASE_URL ?>static/img/logo3.JPG" /></a>
                        <a  class="navbar-brand" href="#"><i class="glyphicon glyphicon-home"></i>GemyCafe</a>
>>>>>>> 449837dcd592cd5f3c6413ea3cac809ea9d4af5f
                    </div>
                    <?php if (!empty($_SESSION['user_id'])) { ?>
                        <ul class="nav navbar-nav collapse navbar-collapse" id='my-nav'>
                            
                            <?php if (!empty($_SESSION['type']) && $_SESSION['type'] == 1) { ?>
<<<<<<< HEAD
				<li><a href="#">Home</a></li>
                                <li><a href="<?= BASE_URL ?>product/index">Products</a></li>
                                <li><a href="<?= BASE_URL ?>user/index">Users</a></li>
                                <li><a href="<?= BASE_URL ?>userpanel/index">Manual Order</a></li>
                                <li><a href="#">Checks</a></li>
                            <?php } elseif ($_SESSION['type'] == 0) { ?>
				<li><a href="<?= BASE_URL ?>userpanel/index">Home</a></li>
                                <li><a href="#">My Orders</a></li>
=======
				<li><a href="<?= BASE_URL ?>orders/index">Home</a></li>
                                <li><a href="<?= BASE_URL ?>product/index">Products</a></li>
                                <li><a href="<?= BASE_URL ?>user/index">Users</a></li>
                                <li><a href="<?= BASE_URL ?>userpanel/index">Manual Order</a></li>
                                <li><a href="<?= BASE_URL ?>checks/index">Checks</a></li>
                            <?php } elseif ($_SESSION['type'] == 0) { ?>
				<li><a href="<?= BASE_URL ?>userpanel/index">Home</a></li>
                                <li><a href="<?= BASE_URL ?>userorder/index">My Orders</a></li>
>>>>>>> 449837dcd592cd5f3c6413ea3cac809ea9d4af5f
                            <?php } ?>
                        </ul>
                        <div>
                            <ul class="nav navbar-nav navbar-right">
                                <?php if (!empty($_SESSION["image"])) { ?>
                                    <li><img width="50px" height="50px" src="<?= BASE_URL ?>uploads/users/<?= $_SESSION['image'] ?>" /></li>
                                <?php } else { ?>
<<<<<<< HEAD
                                    <li><img width="50px" height="50px" src="<?= BASE_URL ?>statis/img/user_image.png" /></li>
=======
                                    <li><img width="50px" height="50px" src="<?= BASE_URL ?>static/img/user_image.png" /></li>
>>>>>>> 449837dcd592cd5f3c6413ea3cac809ea9d4af5f
                                <?php } ?>
                                <?php if (!empty($_SESSION['first_name'])) { ?>
                                    <li style="color:white"><a><i class="glyphicon glyphicon-user"></i> <b><?= !empty($_SESSION['first_name']) ? $_SESSION['first_name'] : "" ?></b></a></li>
                                    <li><a href="<?= BASE_URL ?>login/logout"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
                                    <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </nav>
            </header>
<<<<<<< HEAD
=======
<div id="content" style='background: url("<?= BASE_URL ?>static/img/cafe2.jpg") no-repeat; background-size: 80% 60%; '>
>>>>>>> 449837dcd592cd5f3c6413ea3cac809ea9d4af5f
