<?php


require "config.php";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    # code...
    $response = array();
    $cartID = $_POST['cartID'];
    $type = $_POST['type'];

    $check_cart = mysqli_query($connection, "SELECT * FROM cart WHERE id_cart = '$cartID'");
    $result = mysqli_fetch_array($check_cart);

    $qty = $result['quantity'];

    if ($result) {
        # code...
        if ($type == "plus") {
            # code...
            $update_plus = mysqli_query($connection, "UPDATE cart set quantity = quantity + 1 WHERE id_cart = '$cartID'");
            if ($update_plus) {
                # code...
                $response['value'] = 1;
                $response['message'] = "";
                echo json_encode($response);
            } else {
                # code...
                $response['value'] = 0;
                $response['message'] = "Failed to add the quantity";
                echo json_encode($response);
            }
        } else {
            # code...
            if ($qty == "1") {
                # code...
                $query_delete = mysqli_query($connection, "DELETE FROM cart WHERE id_cart = '$cartID'");
                if ($query_delete) {
                    # code...
                    $response['value'] = 1;
                    $response['message'] = "";
                    echo json_encode($response);
                } else {
                    # code...
                    $response['value'] = 0;
                    $response['message'] = "Failed to add the quantity";
                    echo json_encode($response);
                }
            } else {
                # code...
                $update_minus = mysqli_query($connection, "UPDATE cart set quantity = quantity - 1 WHERE id_cart = '$cartID'");
                if ($update_minus) {
                    # code...
                    $response['value'] = 1;
                    $response['message'] = "";
                    echo json_encode($response);
                } else {
                    # code...
                    $response['value'] = 0;
                    $response['message'] = "Failed to add the quantity";
                    echo json_encode($response);
                }
            }
        }
    } else {
        # code...
        $response['value'] = 0;
        $response['message'] = "Failed to add the quantity";
        echo json_encode($response);
    }
}
?>