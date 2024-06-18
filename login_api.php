<?php

require "config.php";

$admin_email = 'zahidun1102@gmail.com';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $response = array();
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query_check_user = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email'");
    $check_user_result = mysqli_fetch_array($query_check_user);

    if ($check_user_result) {
        if (password_verify($password, $check_user_result['password'])) {
         if ($_POST['email'] == $admin_email) {
            // Admin login
            $response['message'] = "Welcome Zahid Ashraf!";
            $response['is_admin'] = true;
         }else{
            $response['message'] = "Yeay, Login is successful!";
            $response['is_admin'] = false;
         }
            $response['value'] = 1;
            $response['user_id'] = $check_user_result['id_user'];
            $response['name'] = $check_user_result['name'];
            $response['email'] = $check_user_result['email'];
            $response['phone'] = $check_user_result['phone'];
            $response['address'] = $check_user_result['address'];
            $response['created_at'] = $check_user_result['created_at'];
            
            echo json_encode($response);
        } else {
            // Regular user login
            if (password_verify($_POST['password'],$check_user_result['password'])) {
            } else {
               $response['value'] = 2;
               $response['message'] = "Oops, Login Failed!";
               echo json_encode($response);
               }
               }
    } else {
       $response['value'] = 2;
        $response['message'] = "Oops, data is not registered!";
        echo json_encode($response);
        }
        }
        ?>