<?php
    require_once("../../../controllers/supervisorController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    require_once(ROOT."Connection.php");

    $supervisorController = new SupervisorController();
    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();

    if (isset($_GET['cid'])) {
        $chatId = stripslashes($_REQUEST['cid']);  
        $chatId = (int) mysqli_real_escape_string($con, $chatId);

        $supervisorController->messageSeen($chatId);
        header("Location: messages.php");
        die();

    }elseif(isset($_GET['id'])){
        $chatId = stripslashes($_REQUEST['id']);  
        $chatId = (int) mysqli_real_escape_string($con, $chatId);
        $supervisorController->messageSeen($chatId);
        header("Location: chat.php?id=$chatId");
        die();
    }
    else{
        header("Location: messages.php");
        die();
    }
?>