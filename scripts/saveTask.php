<?php
require_once '../contr/controller.php';
$connection = new Connection();
//var_dump($_POST);
if(isset($_POST['id'])&&$_POST['id']!=''){
    try{
        $connection->updateTask($_POST);
    }catch (PDOException $e){
        $_SESSION['error']=$e;
    }
}else{
    try{
        $connection->setTask($_POST);
    }catch (PDOException $e){
        $_SESSION['error']=$e;
    }
}


header('location:../index.php');