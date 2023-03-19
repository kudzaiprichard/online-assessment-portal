<?php
session_start();
    require_once("../../../controllers/studentController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    require_once(ROOT."Connection.php");

    $studentController = new StudentController();

    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();

    if (isset($_GET['comment'])) {
        $taskId = stripslashes($_REQUEST['id']);  
        $taskId = mysqli_real_escape_string($con, $taskId);

        $comment = stripslashes($_REQUEST['comment']);  
        $comment = mysqli_real_escape_string($con, $comment);

        $studentController->commentTask($taskId,$comment);
        header("Location: tasks.php?id=$studentId");
        
        die();

    }
    else{
        header("Location: tasks.php?id=$studentId");
        die();
    }
?>