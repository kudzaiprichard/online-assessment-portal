<?php
    session_start();
    if(!isset($_SESSION["email_address"])) {
        header("Location: ../../auth/signup/signup.php");
        exit();
    }
    require_once("../../../controllers/supervisorController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    require_once(ROOT."Connection.php");

    $supervisorController = new SupervisorController();

    $supervisor = $supervisorController->getLoggedInUser($_SESSION["email_address"]);
    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();

    if (isset($_GET['id'])) {
        $chatId = stripslashes($_REQUEST['id']);  
        $chatId = (int) mysqli_real_escape_string($con, $chatId);

        $chatId = $supervisorController->createChat((int) $supervisor->getId(),$chatId);
        header("Location: chat.php?id=$chatId");
        die();

    }else{
        header("Location: messages.php");
        die();
    }
?>