<?php

class LoginController {

    function index() {
//        die("===");
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
//
//    function forgetPassword() {
//        include 'sendgrid-php/sendgrid-php.php';
//        if ($_SERVER['REQUEST_METHOD'] == "POST") {
//            $user = new UserModel();
//            if (!$user->checkExistence($_POST["email"])) {
//                echo json_encode(array("status" => "fail"));
//                exit();
//            } else {
//                header("Location: " . BASE_URL . "login/resetPassword");
////                $mail = new PHPMailer();
////                $mail->SMTPDebug = 3;
////                $mail->Timeout = 500000;
////                $mail->isSMTP();                                      // Set mailer to use SMTP
////                $mail->Host = "smtp.gmail.com";  // Specify main and backup SMTP servers
////                $mail->SMTPAuth = true;                               // Enable SMTP authentication
////                $mail->Username = 'o.mohamed10@gmail.com';                 // SMTP username
////                $mail->Password = '911910Om@r';                           // SMTP password
////                $mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
////                $mail->Port = 587;                                    // TCP port to connect to
////
////                $mail->setFrom('from@example.com', 'Mailer');
////                $mail->addAddress($_POST["email"], 'omar mohamed');
////
////                $mail->Subject = 'Here is the subject';
////                $mail->Body = 'This is the HTML message body <b>in bold!</b>';
////                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
////
//////                die("===");
////                if (!$mail->send()) {
////                    die("===");
////                    echo 'Message could not be sent.';
////                    echo 'Mailer Error: ' . $mail->ErrorInfo;
////                } else {
////                    die("0000");
////                    echo 'Message has been sent';
////                }
//                $sendgrid = new SendGrid("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");
//                $email = new SendGrid\Email();
//                $email
//                        ->addTo($_POST["email"])
//                        ->setFrom('me@bar.com')
//                        ->setSubject('Subject goes here')
//                        ->setText('Hello World!')
//                        ->setHtml('<strong>Hello World!</strong>');
//                try {
//                    $sendgrid->send($email);
//                } catch (\SendGrid\Exception $e) {
//                    echo $e->getCode();
//                    foreach ($e->getErrors() as $er) {
//                        echo $er;
//                    }
//                }
//            }
//        }
//    }

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
//                $mail = new PHPMailer();
//                $mail->SMTPDebug = 3;
//                $mail->Timeout = 500000;
//                $mail->isSMTP();                                      // Set mailer to use SMTP
//                $mail->Host = "smtp.gmail.com";  // Specify main and backup SMTP servers
//                $mail->SMTPAuth = true;                               // Enable SMTP authentication
//                $mail->Username = 'o.mohamed10@gmail.com';                 // SMTP username
//                $mail->Password = '911910Om@r';                           // SMTP password
//                $mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
//                $mail->Port = 587;                                    // TCP port to connect to
//
//                $mail->setFrom('from@example.com', 'Mailer');
//                $mail->addAddress($_POST["email"], 'omar mohamed');
//
//                $mail->Subject = 'Here is the subject';
//                $mail->Body = 'This is the HTML message body <b>in bold!</b>';
//                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//
////                die("===");
//                if (!$mail->send()) {
//                    die("===");
//                    echo 'Message could not be sent.';
//                    echo 'Mailer Error: ' . $mail->ErrorInfo;
//                } else {
//                    die("0000");
//                    echo 'Message has been sent';
//                }
                $sendgrid = new SendGrid("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");
                $email = new SendGrid\Email();
                $email
                        ->addTo($_POST["email"])
                        ->setFrom('admin@gemycafe.com')
                        ->setSubject('Subject goes here')
                        ->setText('Hello World!')
                        ->setHtml("<a href='".BASE_URL."login/resetPassword'>Reset your Password</a>");
                try {
                    $sendgrid->send($email);
                } catch (\SendGrid\Exception $e) {
                    echo $e->getCode();
                    foreach ($e->getErrors() as $er) {
                        echo $er;
                    }
                }
            }
        }
    }

}
