<?php

class UserpanelController{

	function index(){

        $usrId= $_SESSION['user_id'];
        //$usrId= 2;

		if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $product = new ProductModel();

            $product->data = 'all';
            $product->condition = array('availability'=>"'1'");
            $result = $product->select();
            $num_results = mysqli_num_rows($result);
            $products = array();
            for ($i = 0; $i < $num_results; $i++) {
                $products[] = mysqli_fetch_row($result);
            }



            $room = new RoomModel();
            $room->data = 'all';
            $room->condition = 'no';
            $resultRom = $room->select();
            $num_rom_results = mysqli_num_rows($resultRom);
            $rooms = array();
            for ($i = 0; $i < $num_rom_results; $i++) {
                $rooms[] = mysqli_fetch_row($resultRom);
            }


            $user = new UserModel();
            $user->data = 'all';
            $user->condition = 'no';
            $resultUser = $user->select();
            $num_user_results = mysqli_num_rows($resultUser);
            $users = array();
            for ($i = 0; $i < $num_user_results; $i++) {
                $users[] = mysqli_fetch_row($resultUser);
            }



            $mostR = new OrderdetailsModel();
            $mostR ->user_ID = $usrId;
            $result = $mostR->selectJoin();
            $num_most_results = mysqli_num_rows($result);
            $mostReq = array();
            for ($i = 0; $i < $num_most_results; $i++) {
                $mostReq[] = mysqli_fetch_row($result);
            }

           

            $row = array( $rooms,$products,$users,$mostReq); 
            $template = new Template();
            $template->render("userpanel/index.php",$row);

        } 

        else if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $userId=$_REQUEST["user_id"];
            $roomId=$_REQUEST["room_id"];
            $orderDate=$_REQUEST["order_date"];
            $notes=$_REQUEST["note"];
            $status=$_REQUEST["status"];
            $totalPrice=$_REQUEST["t_price"];

            $notes= preg_replace("/[^A-Za-z0-9]/", " ", $notes);

            

            $order = new OrderModel();
            $order->user_id=$userId;
            $order->room_id=$roomId;
            $order->order_date=$orderDate;
            $order->notes=$notes;
            $order->status=$status;
            $order->total_price= $totalPrice;

            
            $order->check();

            // $order->data=array('user_id' => "'$userId'", 'room_id' => "'$roomId'", 'order_date' => "'$orderDate'",'notes' => "'$notes'", 'status' => "'$status'", 'total_price' => "'$totalPrice'");

             $order->insert();

             //var_dump($order);
    
            

///////////////////////////////////////////order details//////////////////////////////////////////////
            $orderid = new OrderModel();

            $orderid->data = array('id');
            $orderid->condition = array('order_date'=>"'$orderDate'");
            $orderid_result = $orderid->select();

            
            $order_results = mysqli_num_rows($orderid_result);
            $order_id = array();
            for ($i = 0; $i < $order_results; $i++) {
                $order_id [] = mysqli_fetch_row($orderid_result);
            }

            //print_r($order_id);
            //echo $order_id[0][0];

            //echo $orderDate;

            $orders= array();

            $orderDetails = json_decode($_REQUEST["order_details"], true); 
            //var_dump($orderDetails); 
            foreach ($orderDetails as $prod_id => $prod_quantity) {

                array_push($orders, "(".$order_id[0][0].",".$prod_id.",".$prod_quantity.") ");
            }

            //print_r($orders);
            $orders = implode(",", $orders);

            $details = new OrderdetailsModel();

            $details->orderdetails = $orders;
            $details->insertMultiple();
            


////////////////////////////////////////////////////////////////////////////////////////////

            $product = new ProductModel();

            $product->data = 'all';
            $product->condition = array('availability'=>"'1'");
            $result = $product->select();

            
            $num_results = mysqli_num_rows($result);
            $products = array();
            for ($i = 0; $i < $num_results; $i++) {
                $products[] = mysqli_fetch_row($result);
            }



            $room = new RoomModel();
            $room->data = 'all';
            $room->condition = 'no';
            $resultRom = $room->select();
            $num_rom_results = mysqli_num_rows($resultRom);
            $rooms = array();
            for ($i = 0; $i < $num_rom_results; $i++) {
                $rooms[] = mysqli_fetch_row($resultRom);
            }

            $user = new UserModel();
            $user->data = 'all';
            $user->condition = 'no';
            $resultUser = $user->select();
            $num_user_results = mysqli_num_rows($resultUser);
            $users = array();
            for ($i = 0; $i < $num_user_results; $i++) {
                $users[] = mysqli_fetch_row($resultUser);
            }



            $mostR = new OrderdetailsModel();
            $mostR ->user_ID = $usrId;
            $result = $mostR->selectJoin();
            $num_most_results = mysqli_num_rows($result);
            $mostReq = array();
            for ($i = 0; $i < $num_most_results; $i++) {
                $mostReq[] = mysqli_fetch_row($result);
            }

            $row = array( $rooms,$products,$users,$mostReq); 

            $template = new Template();
            $template->render("userpanel/index.php",$row);

        }     

	}



    function update(){

            $product = new ProductModel();

            $product->data = 'all';
            $product->condition = array('availability'=>"'1'");
            $result = $product->select();
            $num_results = mysqli_num_rows($result);
            $products = array();
            for ($i = 0; $i < $num_results; $i++) {
                $products[] = mysqli_fetch_row($result);
            }



            $row = array($products); 

            echo json_encode(array("status" => "success", "insertData" => $row[0]));


    }




    function search(){





            // Get Search
            $search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);

            //$search_string = $_POST['query'];
            $search = new ProductModel();
            $search->searchString = $search_string ;

            $search_string= $search -> check();



            //printf($search_string);

            // Check Length More Than One Character
            if (strlen($search_string) >= 1 && $search_string !== ' ') {


                $search_result= $search -> selectSearch();

                

                $num_results = mysqli_num_rows($search_result);
                $result_array = array();

                for ($i = 0; $i < $num_results; $i++) {
                    $result_array[] = mysqli_fetch_row($search_result);
                }






                // Check If We Have Results
                if (isset($result_array)) {
                                $row = array($result_array); 
                                echo json_encode(array("status" => "success", "insertData" => $row[0]));
                    
                }else{

                    // Format No Results Output

                }
            }



    }


}

?>


