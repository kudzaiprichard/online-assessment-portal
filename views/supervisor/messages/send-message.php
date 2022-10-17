<?php
    require_once("../../../controllers/supervisorController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    require_once(ROOT."Connection.php");

    $supervisorController = new SupervisorController();
    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();

    if (isset($_GET['chat_id'])) {
        $chatId = stripslashes($_REQUEST['chat_id']);  
        $chatId = (int) mysqli_real_escape_string($con, $chatId);

        $message = stripslashes($_REQUEST['message']);   
        $message = mysqli_real_escape_string($con, $message);

        $user = stripslashes($_REQUEST['user']);    
        $user = mysqli_real_escape_string($con, $user);

        
        $supervisorController->sendMessage($chatId, $message, $user);

        header("Location: chat.php?id=$chatId");
        die();

    }else{
        $msg = "Failed To Add!";
        header("Location: students.php?id=$chatId?msg=$msg");
        die();
    }
?>