<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: index.php");
    exit();
}
require_once './config/Database.php';
require_once './classes/Todo.php';
require_once './classes/message.php';


?>