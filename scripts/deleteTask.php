<?php
require_once '../contr/controller.php';
$connection = new Connection();

try{
    $connection->deleteTask($_POST['id']);
}catch (PDOException $e){
    $_SESSION['error']=$e;
}

header('location: ../index.php');