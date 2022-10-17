<?php
session_start();
    require_once("../../../controllers/supervisorController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    require_once(ROOT."Connection.php");

    $supervisorController = new SupervisorController();
    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();

    if (isset($_GET['id'])) {
        $taskId = stripslashes($_REQUEST['id']);  
        $taskId = mysqli_real_escape_string($con, $taskId);

        $studentId = $_SESSION["student_id"];  

        $supervisorController->deleteTaskByTaskId($taskId);
        header("Location: tasks-details.php?id=$studentId");
        die();

    }else{
        header("Location: tasks-details.php?id=$studentId");
        die();
    }
?>