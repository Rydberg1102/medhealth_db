<?php

require 'config.php';

if ($_SERVER['REQUEST_METHOD']) {
    # code...
    $response = array();
    $invoice = date('YmdHis');
    $idUser = $_POST['idUser'];

    $query_check_cart = mysqli_query($connection, "SELECT * FROM cart WHERE id_user = '$idUser'");
    $result_check_cart = mysqli_fetch_array($query_check_cart);

    if ($result_check_cart) {
        # code...
        $insert_invoice = "INSERT INTO orders (id_orders, invoice, id_user, order_at, status) VALUES ('', '$invoice', '$idUser', NOW(), 1)";
        if (mysqli_query($connection, $insert_invoice)) {
            # code...
            $query_insert_cart_detail = mysqli_query($connection, "SELECT * FROM cart WHERE id_user = '$idUser'");
            while ($row_cart = mysqli_fetch_array($query_insert_cart_detail)) {
                # code...
                $idProduct = $row_cart['id_product'];
                $quantity = $row_cart['quantity'];
                $price = $row_cart['price'];

                $insert_invoice_detail = mysqli_query($connection, "INSERT INTO order_details VALUES ('', '$invoice', '$idProduct', '$quantity', '$price')");
            }

            $delete_tmp_cart = mysqli_query($connection, "DELETE FROM cart WHERE id_user = '$idUser'");
            $response['value'] = 1;
            $response['message'] = "Checkout success !";
            echo json_encode($response);
        }else {
            # code...
            $response['value'] = 2;
            $response['message'] = "Checkout failed !";
            echo json_encode($response);
        }

    } else {
        # code...
        $response['value'] = 2;
        $response['message'] = "Product not found !";
        echo json_encode($response);
    }
}
?>