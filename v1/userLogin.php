<?php

require_once '../includes/DbOperations.php';
$response = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['username']) and isset($_POST['password'])){
            $db = new DbOperations();

            if($db->userLogin($_POST['username'], $_POST['password'])){
                $user = $db->getUserByUsername($_POST['username']);
                $response['error'] = false;
                $response['id'] = $user['id'];
                $response['email'] = $user['email'];
                $response['username'] = $user['username'];
                $response['level'] = $user['level'];
            } else{
            $response['error'] = true;
            $response['message'] = "invalid username and password";
            }
        }else{
            $response['error'] = true;
            $response['message'] = "required fields missing";
        }
    }

echo json_encode($response);