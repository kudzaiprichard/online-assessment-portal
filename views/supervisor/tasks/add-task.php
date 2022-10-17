<?php
    require_once("../../../controllers/supervisorController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    require_once(ROOT."Connection.php");

    $supervisorController = new SupervisorController();
    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();

    if (isset($_GET['submit'])) {
        $name = stripslashes($_REQUEST['name']);  
        $name = mysqli_real_escape_string($con, $name);

        $description = stripslashes($_REQUEST['description']);  
        $description = mysqli_real_escape_string($con, $description);

        $studentId = stripslashes($_REQUEST['student']);  
        $studentId = (int) mysqli_real_escape_string($con, $studentId);

        $status = stripslashes($_REQUEST['status']);  
        $status = mysqli_real_escape_string($con, $status);

        $supervisorId = stripslashes($_REQUEST['supervisor']);  
        $supervisorId = (int) mysqli_real_escape_string($con, $supervisorId);

        $supervisorController->createTask($name,$description,$studentId,$status,$supervisorId);
        header("Location: tasks.php?id=$studentId");
        die();

    }elseif(isset($_GET['add'])){
        $name = stripslashes($_REQUEST['name']);  
        $name = mysqli_real_escape_string($con, $name);

        $description = stripslashes($_REQUEST['description']);  
        $description = mysqli_real_escape_string($con, $description);

        $studentId = stripslashes($_REQUEST['student']);  
        $studentId = (int) mysqli_real_escape_string($con, $studentId);

        $status = stripslashes($_REQUEST['status']);  
        $status = mysqli_real_escape_string($con, $status);

        $supervisorId = stripslashes($_REQUEST['supervisor']);  
        $supervisorId = (int) mysqli_real_escape_string($con, $supervisorId);

        $supervisorController->createTask($name,$description,$studentId,$status,$supervisorId);
        header("Location: tasks-details.php?id=$studentId");
        die();
    }
    else{
        header("Location: tasks.php?id=$studentId");
        die();
    }
?>