<?php
    session_start();
    if(!isset($_SESSION["email_address"])) {
        header("Location: ../../auth/signup/signup.php");
        exit();
    }
    require_once("../../../controllers/assessorController.php");
    require_once("../../../controllers/supervisorController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    require_once(ROOT."Connection.php");

    $supervisorController = new SupervisorController();
    $assessorController = new AssessorController();

    $assessor = $assessorController->getLoggedInAssessor($_SESSION["email_address"]);

    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();

    if (isset($_GET['id'])) {
        $supervisorId = stripslashes($_REQUEST['id']);  
        $supervisorId = (int) mysqli_real_escape_string($con, $supervisorId);

        $chatId = $supervisorController->createChat($supervisorId, $assessor->getId());
        header("Location: chat.php?id=$chatId");
        die();

    }else{
        header("Location: messages.php");
        die();
    }
?>