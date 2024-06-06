<?php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # code...
    $response = array();
    $id_user = $_POST['id_user'];
    $id_product = $_POST['id_product'];

    $check_cart = mysqli_query($connection, "SELECT * FROM cart WHERE id_user = '$id_user' AND id_product = '$id_product'");
    $result_check_cart = mysqli_fetch_array($check_cart);

    if ($result_check_cart) {
        # code...
        $response['value'] = 2;
        $response['message'] = "Sorry, the product already have in cart";
        echo json_encode($response);
    } else {
        # code...
        $check_product = mysqli_query($connection, "SELECT * FROM product WHERE id_product = '$id_product'");
        $fetch_product = mysqli_fetch_array($check_product);
        $fetch_price = $fetch_product['price'];

        $insert_to_cart = "INSERT INTO cart VALUE ('', '$id_user', '$id_product', 1, '$fetch_price', NOW())";

        if (mysqli_query($connection, $insert_to_cart)) {
            # code...
            $response['value'] = 1;
            $response['message'] = "Yeayy, your product has been added to cart";
            echo json_encode($response);
        } else {
            # code...
            $response['value'] = 0;
            $response['message'] = "Sorry, added product failed";
            echo json_encode($response);
        }
        
    }
}
?>