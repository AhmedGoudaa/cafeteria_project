<?php

class LoginController {

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {

            $template = new Template();
            $template->render("login/index.php");
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = new UserModel();
            $userData = $user->checkLogin($_POST['email'], $_POST['password']);
            if (!empty($userData)) {
                $_SESSION['type'] = $userData["type"];
                $_SESSION['email'] = $userData["email"];
                $_SESSION['image'] = $userData["picture"];

                $_SESSION['first_name'] = $userData["fname"];
                $_SESSION['user_id'] = $userData["id"];

                if ($_SESSION['type'] == 1) {
                    echo json_encode(array("status" => "success", "type" => 1));
                } else {
                    echo json_encode(array("status" => "success", "type" => 0));
                }
            } else {
                echo json_encode(array("status" => "failed"));
            }
            exit();
        }
    }

    function logout() {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            session_destroy();
            header("Location: " . BASE_URL . "login/index");
        }
    }

    function sendEmail() {

        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $template = new Template();
            $template->render("login/sendEmail.php");
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = new UserModel();
            if (!$user->checkExistence($_POST["email"])) {
                echo json_encode(array("status" => "fail"));
                exit();
            } else {
                $sendgrid = new SendGrid();
                $email = new SendGrid\Email();
                $email
                        ->addTo($_POST["email"])
                        ->setFrom('admin@gemycafe.com')
                        ->setSubject('Reset Password GemyCafe')
                        ->setText('Reset Password')
                        ->setHtml("<a href='" . BASE_URL . "login/resetPassword'>Reset your Password</a>");
                try {
                    $sendgrid->send($email);
                    $_SESSION["email"] = $_POST['email'];
                    echo json_encode(array("status" => "success"));
                    exit();
                } catch (\SendGrid\Exception $e) {
//                    echo $e->getCode();
//                    foreach ($e->getErrors() as $er) {
//                        echo $er;
//                    }
                    echo json_encode(array("status" => "abort"));
                    exit();
                }
            }
        }
    }

    function confirmEmail() {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $template = new Template();
            $template->render("login/confirmEmail.php");
        }
    }

    function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $template = new Template();
            $template->render("login/resetPassword.php");
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            $valid = false;
            $error = array();

            $email = $_SESSION["email"];

            if (!empty($_POST["resetPassword"]) || !empty($_POST["resetCoPassword"])) {
                if (empty($_POST["resetPassword"])) {
                    $error['r_u_passError'] = "* Password is required";
                } elseif (empty($_POST["resetCoPassword"])) {
                    $error['r_u_copassError'] = "* Confirm Password is required";
                } elseif ($_POST["resetPassword"] != $_POST["resetCoPassword"]) {
                    $error['r_u_copassError'] = "* Password isn't matched";
                } else {
                    $u_pass = md5($_POST["resetPassword"]);
                }
            }

            $errors = array_filter($error);

            if (empty($errors)) {
                $valid = true;
            }

            if ($valid) {
                $user = new UserModel();
                if (!empty($u_pass)) {
                    $user->data['password'] = "'$u_pass'";
                }
                $user->condition = array("email" => "'$email'");
                if (!$user->update()) {
                    echo json_encode(array("status" => "errorPassword"));
                } else {
                    echo json_encode(array("status" => "success"));
                }
                exit();
            } else {
                echo json_encode(array("status" => "failed", "error" => $error));
            }
            exit();
        }
    }

    function resetDone() {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $template = new Template();
            $template->render("login/resetDone.php");
        }
    }

}
