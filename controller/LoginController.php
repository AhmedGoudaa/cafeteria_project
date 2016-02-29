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

    function forgetPassword() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = new UserModel();
//            print_r($_POST);die("==");
            if (!$user->checkExistence($_POST["email"])) {
                echo json_encode(array("status" => "fail"));
                exit();
            } else {
                $mail = new PHPMailer();
                $mail->SMTPDebug = 3;
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.mailgun.org';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'postmaster@sandboxea5782d709be4a3aa4a8853e3ca32561.mailgun.org';                 // SMTP username
                $mail->Password = '01bd927a2a9f7646f6891bfb6744258e';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                $mail->setFrom('from@example.com', 'Mailer');
                $mail->addAddress('o.mohamed10@gmail.com', 'omar mohamed');

                $mail->Subject = 'Here is the subject';
                $mail->Body = 'This is the HTML message body <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if (!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message has been sent';
                }
            }
        }
    }

}
