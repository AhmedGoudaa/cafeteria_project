<?php

class ProductController {

    public function __construct() {
        if ($_SESSION['type'] == 0) {
            header("Location: " . BASE_URL . "errorHandler/index");
        }
    }

    function index() {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $product = new ProductModel();

            $product->data = 'all';
            $product->condition = 'no';
            $result = $product->select();
            $num_results = mysqli_num_rows($result);
            $products = array();
            for ($i = 0; $i < $num_results; $i++) {
                $products[] = mysqli_fetch_assoc($result);
            }

            $category = new CategoryModel();
            $category->data = 'all';
            $category->condition = 'no';
            $resultCat = $category->select();
            $num_cat_results = mysqli_num_rows($resultCat);
            $categories = array();
            for ($i = 0; $i < $num_cat_results; $i++) {
                $categories[] = mysqli_fetch_assoc($resultCat);
            }

            $row = array("categories" => $categories, "products" => $products);


            $template = new Template();
            $template->render("product/index.php", $row);
        }
    }

    function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $fileError = true;
            $priceCHK = true;
            $valid = false;
            if ($_FILES['product_photo']['error'] > 0) {
                $fileError = false;
                switch ($_FILES['product_photo']['error']) {
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
                if (!preg_match($imageRegex, $_FILES['product_photo']['type'])) {
                    $error['fileError'] = 'Problem: file is not image';
                    $fileError = false;
                }
            }

            if (empty($_POST["product_name"])) {
                $error['p_nameError'] = "* Product name is required";
            } else {
                $p_name = $_POST["product_name"];
            }
            if (empty($_POST["product_price"]) || !is_numeric($_POST["product_price"])) {
                $error['p_priceError'] = "* Product price is required (numeric)";
                $priceCHK = false;
            } else {
                $p_price = abs($_POST["product_price"]);
            }

            if (empty($_POST["product_cat"])) {
                $error['p_catError'] = "* Product Category is required";
            } else {
                $p_cat = $_POST["product_cat"];
            }

            if (!empty($_POST["product_name"]) && $priceCHK && !empty($_POST["product_cat"]) && $fileError) {
                $valid = true;
            }

            if ($valid) {
                $fileUploaded = true;
                if (is_uploaded_file($_FILES['product_photo']['tmp_name'])) {
                    $image_name = time() . $_FILES['product_photo']['name'];
                    $upfile = APP_PATH . '/uploads/products/' . $image_name;

                    if (!move_uploaded_file($_FILES['product_photo']['tmp_name'], $upfile)) {
                        $fileUploaded = false;
                    }
                } else {
                    $fileUploaded = false;
                }

                if (!$fileUploaded) {
                    echo json_encode(array("status" => "errorUpload"));
                    exit();
                }

                $product = new ProductModel();
                $product->name = $p_name;
                $product->cat_id = $p_cat;
                $product->availability = true;
                $product->photo = $image_name;
                $product->price = $p_price;

                if (!$product->insert()) {
                    echo json_encode(array("status" => "errorInsert"));
                } else {

                    global $conn;
                    $id = mysqli_insert_id($conn);

                    $product = new ProductModel();
                    $product->data = 'all';
                    $product->condition = array("id" => $id);
                    $result = $product->select();
                    $num_results = mysqli_num_rows($result);
                    $insertData = array();
                    for ($i = 0; $i < $num_results; $i++) {
                        $insertData[] = mysqli_fetch_assoc($result);
                    }

                    echo json_encode(array("status" => "success", "insertData" => $insertData[0]));
                }
                exit();
            } else {
                echo json_encode(array("status" => "failed", "error" => $error));
            }
            exit();
        }
    }

    function editProduct() {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $product = new ProductModel();
            $product->data = 'all';
            $product->condition = array("id" => $_GET["product_id"]);
            $result = $product->select();
            $num_results = mysqli_num_rows($result);
            $editProduct = array();
            for ($i = 0; $i < $num_results; $i++) {
                $editProduct[] = mysqli_fetch_assoc($result);
            }

            echo json_encode(array("status" => "success", "editRow" => $editProduct));
            exit();
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {


            $fileError = true;
            $valid = false;
            $error = false;

            $id = $_POST["editID"];
            if (!empty($_FILES['e_product_photo']['name'])) {
                if ($_FILES['e_product_photo']['error'] > 0) {
                    $fileError = false;
                    switch ($_FILES['e_product_photo']['error']) {
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
                    if (!preg_match($imageRegex, $_FILES['e_product_photo']['type'])) {
                        $error['e_fileError'] = 'Problem: file is not image';
                        $fileError = false;
                    }
                }
            }

            if (empty($_POST["e_product_name"])) {
                $error['e_p_nameError'] = "* Product name is required";
            } else {
                $p_name = $_POST["e_product_name"];
            }
            if (empty($_POST["e_product_price"])) {
                $error['e_p_priceError'] = "* Product price is required";
            } else {
                $p_price = abs($_POST["e_product_price"]);
            }

            if (empty($_POST["e_product_cat"])) {
                $error['e_p_catError'] = "* Product Category is required";
            } else {
                $p_cat = $_POST["e_product_cat"];
            }

            if (!empty($_POST["e_product_name"]) && !empty($_POST["e_product_price"]) && !empty($_POST["e_product_cat"]) && $fileError) {
                $valid = true;
            }
            if ($valid) {
                $product = new ProductModel();
                if (!empty($_FILES['e_product_photo']['name'])) {
                    $fileUploaded = true;
                    if (is_uploaded_file($_FILES['e_product_photo']['tmp_name'])) {
                        $image_name = time() . $_FILES['e_product_photo']['name'];
                        $upfile = APP_PATH . '/uploads/products/' . $image_name;

                        if (!move_uploaded_file($_FILES['e_product_photo']['tmp_name'], $upfile)) {
                            $fileUploaded = false;
                        }
                    } else {
                        $fileUploaded = false;
                    }


                    if (!$fileUploaded) {
                        echo json_encode(array("status" => "errorUpload"));
                        exit();
                    }
                    $product->data = array("name" => "'$p_name'", "cat_id" => "'$p_cat'", "photo" => "'$image_name'", "price" => "'$p_price'");
                } else {
                    $product->data = array("name" => "'$p_name'", "cat_id" => "'$p_cat'", "price" => "'$p_price'");
                }

                $product->condition = array("id" => $id);

                if (!$product->update()) {
                    echo json_encode(array("status" => "errorEdit"));
                } else {

                    $product = new ProductModel();
                    $product->data = 'all';
                    $product->condition = array("id" => $id);
                    $result = $product->select();
                    $num_results = mysqli_num_rows($result);
                    $editProduct = array();
                    for ($i = 0; $i < $num_results; $i++) {
                        $editProduct[] = mysqli_fetch_assoc($result);
                    }

                    echo json_encode(array("status" => "success", "editData" => $editProduct[0]));
                }
                exit();
            } else {
                echo json_encode(array("status" => "failed", "error" => $error));
            }
            exit();
        }
    }

    function deleteProduct() {
//        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $product = new ProductModel();
            $product->data = array('photo');
            $product->condition = array("id" => $_POST["product_id"]);
            $result = $product->select();
            $num_results = mysqli_num_rows($result);
            $image = array();
            for ($i = 0; $i < $num_results; $i++) {
                $image = mysqli_fetch_assoc($result);
            }

            $product->data = array('id' => $_POST["product_id"]);
            if ($product->delete()) {
                unlink(APP_PATH . "/uploads/products/" . $image['photo']);
                echo json_encode(array("status" => "success"));
            } else {
                echo json_encode(array("status" => "failed"));
            }
            exit();
        }
    }

}
