<?php

class UserController {

    public function __construct() {
        if ($_SESSION['type'] == 0) {
            header("Location: " . BASE_URL . "errorHandler/index");
        }
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $user = new UserModel();
            $users = $user->selectUserAndRoom();

            $room = new RoomModel();
            $room->data = 'all';
            $room->condition = 'no';
            $resultRoom = $room->select();
            $num_cat_results = mysqli_num_rows($resultRoom);
            $rooms = array();
            for ($i = 0; $i < $num_cat_results; $i++) {
                $rooms[] = mysqli_fetch_assoc($resultRoom);
            }

            $row = array("rooms" => $rooms, "users" => $users);

            $template = new Template();
            $template->render("user/index.php", $row);
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
            die("====");
        }
    }

    function addUser() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $error = array();
            $valid = false;

            if ($_FILES['user_photo']['error'] > 0) {
                switch ($_FILES['user_photo']['error']) {
                    case 1: $error['fileError'] = 'File exceeded upload_max_filesize';
                        break;
                    case 2: $error['fileError'] = 'File exceeded max_file_size';
                        break;
                    case 3: $error['fileError'] = 'File only partially uploaded';
                        break;
                    case 4: $error['fileError'] = 'No file uploaded';
                        break;
                    case 6: $error['fileError'] = 'Cannot upload file: No temp directory specified';
                        break;
                    case 7: $error['fileError'] = 'Upload failed: Cannot write to disk';
                        break;
                }
            } else {
                $imageRegex = "/^(image)/";
                if (!preg_match($imageRegex, $_FILES['user_photo']['type'])) {
                    $error['fileError'] = 'Problem: file is not image';
                }
            }
            $user = new UserModel();

            if (empty($_POST["user_fname"])) {
                $error['u_fnameError'] = "* First name is required";
            } else {
                $u_fname = $_POST["user_fname"];
            }
            if (empty($_POST["user_lname"])) {
                $error['u_lnameError'] = "* Last name is required";
            } else {
                $u_lname = $_POST["user_lname"];
            }
            if (empty($_POST["user_ext"]) || !is_numeric($_POST["user_ext"])) {
                $error['u_extError'] = "* Ext. is required (numeric)";
            } else {
                $u_ext = abs($_POST["user_ext"]);
            }

            if (empty($_POST["user_room"])) {
                $error['u_roomError'] = "* Room No. is required";
            } else {
                $u_room = $_POST["user_room"];
            }

            if (empty($_POST["user_email"])) {
                $error['u_emailError'] = "* Email is required";
            } else if (!preg_match("/^([a-zA-Z]|[a-zA-Z][a-zA-Z0-9_\-\.]+)@[a-zA-Z0-9\-]+((\.[a-zA-Z]{2,3}){1}|(\.[a-zA-Z]{2,3}\.[a-zA-Z]{2}){1})$/", $_POST["user_email"])) {
                $error['u_emailError'] = "* Email isn't valid";
            } else if ($user->checkExistence($_POST["user_email"])) {
                $error['u_emailError'] = "* This email exists before";
            } else {
                $u_email = $_POST["user_email"];
            }

            if (empty($_POST["user_password"])) {
                $error['u_passError'] = "* Password is required";
            } elseif (empty($_POST["user_co_password"])) {
                $error['u_copassError'] = "* Confirm Password is required";
            } elseif ($_POST["user_password"] != $_POST["user_password"]) {
                $error['u_copassError'] = "* Password isn't matched";
            } else {
                $u_pass = md5($_POST["user_password"]);
            }

            $errors = array_filter($error);

            if (empty($errors)) {
                $valid = true;
            }

            if ($valid) {
                $fileUploaded = true;
                if (is_uploaded_file($_FILES['user_photo']['tmp_name'])) {
                    $image_name = time() . $_FILES['user_photo']['name'];
                    $upfile = APP_PATH . '/uploads/users/' . $image_name;

                    if (!move_uploaded_file($_FILES['user_photo']['tmp_name'], $upfile)) {
                        $fileUploaded = false;
                    }
                } else {
                    $fileUploaded = false;
                }

                if (!$fileUploaded) {
                    echo json_encode(array("status" => "errorUpload"));
                    exit();
                }

                $user = new UserModel();
                $user->fname = $u_fname;
                $user->lname = $u_lname;
                $user->room_id = $u_room;
                $user->ext = $u_ext;
                $user->email = $u_email;
                $user->password = $u_pass;
                $user->type = 0;
                $user->picture = $image_name;

                if (!$user->insert()) {
                    echo json_encode(array("status" => "errorInsert"));
                } else {

                    global $conn;
                    $id = mysqli_insert_id($conn);

                    $insertData = $user->selectUserAndRoom($id);


                    echo json_encode(array("status" => "success", "insertData" => $insertData[0]));
                }
                exit();
            } else {
                echo json_encode(array("status" => "failed", "error" => $error));
            }
            exit();
        }
    }

    function editUser() {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $user = new UserModel();
            $user->data = 'all';
            $user->condition = array("id" => $_GET["user_id"]);
            $result = $user->select();
            $num_results = mysqli_num_rows($result);
            $editUser = array();
            for ($i = 0; $i < $num_results; $i++) {
                $editUser = mysqli_fetch_assoc($result);
            }

            echo json_encode(array("status" => "success", "editRow" => $editUser));
            exit();
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $valid = false;
            $error = array();

            $id = $_POST["editID"];
            if (!empty($_FILES['e_user_photo']['name'])) {
                if ($_FILES['e_user_photo']['error'] > 0) {
                    switch ($_FILES['e_user_photo']['error']) {
                        case 1: $error['e_fileError'] = 'File exceeded upload_max_filesize';
                            break;
                        case 2: $error['e_fileError'] = 'File exceeded max_file_size';
                            break;
                        case 3: $error['e_fileError'] = 'File only partially uploaded';
                            break;
                        case 4: $error['e_fileError'] = 'No file uploaded';
                            break;
                        case 6: $error['e_fileError'] = 'Cannot upload file: No temp directory specified';
                            break;
                        case 7: $error['e_fileError'] = 'Upload failed: Cannot write to disk';
                            break;
                    }
                } else {
                    $imageRegex = "/^(image)/";
                    if (!preg_match($imageRegex, $_FILES['e_user_photo']['type'])) {
                        $error['e_fileError'] = 'Problem: file is not image';
                    }
                }
            }

            if (empty($_POST["e_user_fname"])) {
                $error['e_u_fnameError'] = "* First name is required";
            } else {
                $u_fname = $_POST["e_user_fname"];
            }
            if (empty($_POST["e_user_lname"])) {
                $error['e_u_lnameError'] = "* Last name is required";
            } else {
                $u_lname = $_POST["e_user_lname"];
            }
            if (empty($_POST["e_user_ext"]) || !is_numeric($_POST["e_user_ext"])) {
                $error['e_u_extError'] = "* Ext. is required (numeric)";
            } else {
                $u_ext = abs($_POST["e_user_ext"]);
            }

            if (empty($_POST["e_user_room"])) {
                $error['e_u_roomError'] = "* Room No. is required";
            } else {
                $u_room = $_POST["e_user_room"];
            }

            if (empty($_POST["e_user_email"])) {
                $error['e_u_emailError'] = "* Email is required";
            } else if (!preg_match("/^([a-zA-Z]|[a-zA-Z][a-zA-Z0-9_\-\.]+)@[a-zA-Z0-9\-]+((\.[a-zA-Z]{2,3}){1}|(\.[a-zA-Z]{2,3}\.[a-zA-Z]{2}){1})$/", $_POST["e_user_email"])) {
                $u_email = $_POST["e_user_email"];
                $error['e_u_emailError'] = "* Email isn't valid";
            } else {
                $u_email = $_POST["e_user_email"];
            }


            if (!empty($_POST["e_user_password"]) || !empty($_POST["e_user_co_password"])) {
                if (empty($_POST["e_user_password"])) {
                    $error['e_u_passError'] = "* Password is required";
                } elseif (empty($_POST["e_user_co_password"])) {
                    $error['e_u_copassError'] = "* Confirm Password is required";
                } elseif ($_POST["e_user_password"] != $_POST["e_user_co_password"]) {
                    $error['e_u_copassError'] = "* Password isn't matched";
                } else {
                    $u_pass = md5($_POST["e_user_password"]);
                }
            }

            $errors = array_filter($error);

            if (empty($errors)) {
                $valid = true;
            }

            if ($valid) {
                $user = new UserModel();
                if (!empty($_FILES['e_user_photo']['name'])) {
                    $fileUploaded = true;
                    if (is_uploaded_file($_FILES['e_user_photo']['tmp_name'])) {
                        $image_name = time() . $_FILES['e_user_photo']['name'];
                        $upfile = APP_PATH . '/uploads/users/' . $image_name;

                        if (!move_uploaded_file($_FILES['e_user_photo']['tmp_name'], $upfile)) {
                            $fileUploaded = false;
                        }
                    } else {
                        $fileUploaded = false;
                    }


                    if (!$fileUploaded) {
                        echo json_encode(array("status" => "errorUpload"));
                        exit();
                    }

                    $user->data = array("fname" => "'$u_fname'", "lname" => "'$u_lname'", "room_id" => "'$u_room'", "ext" => "'$u_ext'", "email" => "'$u_email'", "picture" => "'$image_name'");
                } else {
                    $user->data = array("fname" => "'$u_fname'", "lname" => "'$u_lname'", "room_id" => "'$u_room'", "ext" => "'$u_ext'", "email" => "'$u_email'");
                }
                if (!empty($u_pass)) {
                    $user->data['password'] = "'$u_pass'";
                }

                $user->condition = array("id" => $id);

                if (!$user->update()) {
                    echo json_encode(array("status" => "errorEdit"));
                } else {


                    $editUser = $user->selectUserAndRoom($id);

                    echo json_encode(array("status" => "success", "editData" => $editUser[0]));
                }
                exit();
            } else {
                echo json_encode(array("status" => "failed", "error" => $error));
            }
            exit();
        }
    }

    function deleteUser() {
//        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $user = new UserModel();
            $user->data = array('picture', 'type');
            $user->condition = array("id" => $_POST["user_id"]);
            $result = $user->select();
            $num_results = mysqli_num_rows($result);
            $selectData = array();
            for ($i = 0; $i < $num_results; $i++) {
                $selectData = mysqli_fetch_assoc($result);
            }
            if ($selectData['type'] == 1) {
                echo json_encode(array("status" => "failed"));
                exit();
            }

            $user->data = array('id' => $_POST["user_id"]);
            if ($user->delete()) {
                unlink(APP_PATH . "/uploads/users/" . $selectData['picture']);
                echo json_encode(array("status" => "success"));
            } else {
                echo json_encode(array("status" => "failed"));
            }
            exit();
        }
    }

}
