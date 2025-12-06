<?php

function setMessage($name, $message, $type = 'success'){
    if(!isset($_SESSION['flash_message'])){
        $_SESSION['flash_message'] = [];
    }

    $_SESSION['flash_message'][$name] = [ 'message' => $message, 'type' => $type ];
}


function getMessage($name){
    if(isset($_SESSION['flash_message'][$name])){
        $message = $_SESSION['flash_message'][$name];
        unset($_SESSION['flash_message'][$name]);
        return $message;
    }
    return null;
}