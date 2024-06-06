<?php

require "config.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $response = array();
    $full_name = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = md5($_POST['password']);

    $query_check_user = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email' || phone = '$phone'");
    $check_user_result = mysqli_fetch_array($query_check_user);

    if ($check_user_result) {
        # code...
        $response['value'] = 0;
        $response['mes
        sage'] = "Oops, sorry data have been registered !";
        echo json_encode($response);
    }else{
        $query_insert_user = mysqli_query($connection, "INSERT INTO user VALUE('', '$full_name', '$email', '$phone', '$address', '$password', NOW(), 1)");
         if ($query_insert_user) {
            # code...
            $response['value'] = 1;
            $response['message'] = "Yeay, Registration is successful. Please login with your account !";
            echo json_encode($response);
         } else {
            # code...
            $response['value'] = 2;
            $response['message'] = "Oops, Registration Failed!";
            echo json_encode($response);
         }
    }
}
?>