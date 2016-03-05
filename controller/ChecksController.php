<?php

class checksController {
  
    public function index() {

        if ($_SERVER['REQUEST_METHOD'] == "GET") {

            $users = new UserModel();
            $result1 = $users->usersTotalOrders();
            $num_results = mysqli_num_rows($result1);
            $usersOrder = array();
            for ($i = 0; $i < $num_results; $i++) {
                $usersOrder[] = mysqli_fetch_assoc($result1);
            }

            $order = new OrderModel();
            $result2 = $order->allOrders();
//            print_r($result2);
            $num_results2 = mysqli_num_rows($result2);
            $orders = array();

            for ($i = 0; $i < $num_results2; $i++) {
                $orders[] = mysqli_fetch_assoc($result2);
            }

            $this->commen($usersOrder, $orders);
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['userId'])) {
                $users = new UserModel();
                $user = $users->getUserOrders($_POST['userId']);
                $num = mysqli_num_rows($user);
                $usersOrder = array();
                for ($i = 0; $i < $num; $i++) {
                    $usersOrder[] = mysqli_fetch_assoc($user);
                }
                $order = new OrderModel();
                $result2 = $order->userOrders($_POST['userId']);
                //            print_r($result2);
                $num_results2 = mysqli_num_rows($result2);
                $orders = array();

                for ($i = 0; $i < $num_results2; $i++) {
                    $orders[] = mysqli_fetch_assoc($result2);
                }
                $allUsers = $users->getAllUsers();
                $num = mysqli_num_rows($allUsers);
                $usersArr = array();
                for ($i = 0; $i < $num; $i++) {
                    $usersArr[] = mysqli_fetch_assoc($allUsers);
                }
                $order = new OrderModel();

                $result3 = $order->allOrdersDetails();
//            print_r($result2);
                $num_results3 = mysqli_num_rows($result3);
                $allOrdersDetails = array();

                for ($i = 0; $i < $num_results3; $i++) {
                    $allOrdersDetails[] = mysqli_fetch_assoc($result3);
                }


                $row = array("usersArr" => $usersArr, "usersOrder" => $usersOrder, "orders" => $orders, "allOrdersDetails" => $allOrdersDetails);
                $template = new Template();
                $template->render("checks/filter.php", $row);
            } elseif (isset($_POST['datefrom']) && isset($_POST['dateto'])) {
                if (!(empty($_POST['datefrom'])) && !(empty($_POST['dateto']))) {
                    $part = explode('-', $_POST['datefrom']);
                    $from = $part[2] . '-' . $part[0] . '-' . $part[1];
                    $parts = explode('-', $_POST['dateto']);
                    $to = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
                    $from = $from . " 12:00 AM";
                    $to = $to . " 11:59 PM";
                    $from = DATE(" Y-m-d H:i:s ", STRTOTIME($from));
                    $to = DATE(" Y-m-d H:i:s ", STRTOTIME($to));
                    $users = new UserModel();
                    $result1 = $users->usersTotalOrdersbyDate($from, $to);
                    $num_results = mysqli_num_rows($result1);
                    $usersOrder = array();
                    for ($i = 0; $i < $num_results; $i++) {
                        $usersOrder[] = mysqli_fetch_assoc($result1);
                    }
                    $order = new OrderModel();
                    $result2 = $order->usersOrdersByDate($from, $to);
//                            print_r($result2);
                    $num_results2 = mysqli_num_rows($result2);
                    $orders = array();

                    for ($i = 0; $i < $num_results2; $i++) {
                        $orders[] = mysqli_fetch_assoc($result2);
                    }

                    $allUsers = $users->getAllUsers();
                    $num = mysqli_num_rows($allUsers);
                    $usersArr = array();
                    for ($i = 0; $i < $num; $i++) {
                        $usersArr[] = mysqli_fetch_assoc($allUsers);
                    }
                    $order = new OrderModel();

                    $result3 = $order->allOrdersDetails();
//            print_r($result2);
                    $num_results3 = mysqli_num_rows($result3);
                    $allOrdersDetails = array();

                    for ($i = 0; $i < $num_results3; $i++) {
                        $allOrdersDetails[] = mysqli_fetch_assoc($result3);
                    }


                    $row = array("usersArr" => $usersArr, "usersOrder" => $usersOrder, "orders" => $orders, "allOrdersDetails" => $allOrdersDetails);
                    $template = new Template();
                    $template->render("checks/filter.php", $row);
                } else {
                    header('location: ' . BASE_URL . 'checks');
                }
            }
        }
    }

    public function commen($usersOrder, $orders) {
        $users = new UserModel();

        $allUsers = $users->getAllUsers();
        $num = mysqli_num_rows($allUsers);
        $usersArr = array();
        for ($i = 0; $i < $num; $i++) {
            $usersArr[] = mysqli_fetch_assoc($allUsers);
        }
        $order = new OrderModel();

        $result3 = $order->allOrdersDetails();
//            print_r($result2);
        $num_results3 = mysqli_num_rows($result3);
        $allOrdersDetails = array();

        for ($i = 0; $i < $num_results3; $i++) {
            $allOrdersDetails[] = mysqli_fetch_assoc($result3);
        }


        $row = array("usersArr" => $usersArr, "usersOrder" => $usersOrder, "orders" => $orders, "allOrdersDetails" => $allOrdersDetails);
        $template = new Template();
        $template->render("checks/index.php", $row);
    }

    function update() {
        $users = new UserModel();
        $result1 = $users->usersTotalOrders();
        $num_results = mysqli_num_rows($result1);
        $usersOrder = array();
        for ($i = 0; $i < $num_results; $i++) {
            $usersOrder[] = mysqli_fetch_assoc($result1);
        }

        $order = new OrderModel();
        $result2 = $order->allOrders();
//            print_r($result2);
        $num_results2 = mysqli_num_rows($result2);
        $orders = array();

        for ($i = 0; $i < $num_results2; $i++) {
            $orders[] = mysqli_fetch_assoc($result2);
        }

        $allUsers = $users->getAllUsers();
        $num = mysqli_num_rows($allUsers);
        $usersArr = array();
        for ($i = 0; $i < $num; $i++) {
            $usersArr[] = mysqli_fetch_assoc($allUsers);
        }
        $order = new OrderModel();

        $result3 = $order->allOrdersDetails();
//            print_r($result2);
        $num_results3 = mysqli_num_rows($result3);
        $allOrdersDetails = array();

        for ($i = 0; $i < $num_results3; $i++) {
            $allOrdersDetails[] = mysqli_fetch_assoc($result3);
        }


        $row = array("usersArr" => $usersArr, "usersOrder" => $usersOrder, "orders" => $orders, "allOrdersDetails" => $allOrdersDetails);

        echo json_encode(array("status" => "success", "insertData" => $row));
    }

}
