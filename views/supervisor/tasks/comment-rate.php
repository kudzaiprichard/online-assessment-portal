<?php
session_start();
    require_once("../../../controllers/supervisorController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    require_once(ROOT."Connection.php");

    $supervisorController = new SupervisorController();
    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();

    if (isset($_GET['comment'])) {
        $taskId = stripslashes($_REQUEST['id']);  
        $taskId = mysqli_real_escape_string($con, $taskId);

        $comment = stripslashes($_REQUEST['comment']);  
        $comment = mysqli_real_escape_string($con, $comment);

        $rate = stripslashes($_REQUEST['rate']);  
        $rate = (int) mysqli_real_escape_string($con, $rate);

        $studentId = $_SESSION["student_id"];  

        $supervisorController->rateAndCommentTask($taskId,$comment,$rate);
        header("Location: tasks-details.php?id=$studentId");
        
        die();

    }
    else{
        header("Location: tasks-details.php?id=$studentId");
        die();
    }
?>