<?php

require "config.php";

$response = array();
$id_user = $_GET['id_user'];

$query_select_order = mysqli_query($connection, "SELECT * FROM orders WHERE id_user = '$id_user'");

while ($row_order = mysqli_fetch_array($query_select_order)) {
    # code...
    $no_invoice = $row_order['invoice'];
    $key['invoice'] = $no_invoice;
    $key['id_user'] = $row_order['id_user'];
    $key['order_at'] = $row_order['order_at'];
    $key['status'] = $row_order['status'];
    $key['detail'] = array();

    $query_select_order_detail = mysqli_query($connection, "SELECT order_details.*, product.name FROM order_details JOIN product on 
    order_details.id_product = product.id_product WHERE order_details.invoice = '$no_invoice'");

    while ($row_order_detail = mysqli_fetch_array($query_select_order_detail)) {
        # code...
        $key['detail'][] = array(
            "id_orders" => $row_order_detail['id_orders'],
            "invoice" => $row_order_detail['invoice'],
            "id_product" => $row_order_detail['id_product'],
            "nameProduct" => $row_order_detail['name'],
            "quantity" => $row_order_detail['quantity'],
            "price" => $row_order_detail['price'],
        );
    }
    array_push($response, $key);
}
echo json_encode($response);
?>