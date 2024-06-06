<?php

require "config.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $response = array();
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query_check_user = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email'");
    $check_user_result = mysqli_fetch_array($query_check_user);

    if ($check_user_result) {
        # code...
        $query_login = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email' && password = '$password'");
        if ($query_login) {
            # code...
            $response['value'] = 1;
            $response['message'] = "Yeay, Login is successful!";
            $response['user_id'] = $check_user_result['id_user'];
            $response['name'] = $check_user_result['name'];
            $response['email'] = $check_user_result['email'];
            $response['phone'] = $check_user_result['phone'];
            $response['address'] = $check_user_result['address'];
            $response['created_at'] = $check_user_result['created_at'];
            $response['user_id'] = $check_user_result['id_user'];
            $response['message'] = "Yeay, Login is successful!";
            echo json_encode($response);
         } else {
            # code...
            $response['value'] = 2;
            $response['message'] = "Oops, Login Failed!";
            echo json_encode($response);
         }
    }  else{
            # code...
            $response['value'] = 2;
            $response['message'] = "Oops, data is not registered !";
            echo json_encode($response);
         }
    
}
?>