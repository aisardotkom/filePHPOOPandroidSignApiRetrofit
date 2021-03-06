<?php

require_once '../includes/DbOperations.php';
$response = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(
            isset($_POST['username']) and
                isset($_POST['email']) and
                    isset($_POST['password']))
                    {
                        //operate
                        $db = new DbOperations();
                        
                        $result = $db->createUser(
                                            $_POST['username'],
                                            $_POST['password'],
                                            $_POST['email']
                        );
                        if($result == 1){
                            $response['error'] = false;
                            $response['message'] = "user regis sukses";
                        } elseif($result == 2){
                            $response['error'] = true;
                            $response['message'] = "error coba lagi";
                        } elseif($result == 0){
                            $response['error'] = true;
                            $response['message'] = "user already on database";
                        } 
                }else{
                $response['error'] = true;
                $response['message'] = "required fields missing";
                    }
    } else{
        $response['error'] = true;
        $response['message'] = "invalid request";
    }
    echo json_encode($response);
