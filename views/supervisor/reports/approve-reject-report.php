<?php
session_start();
    require_once("../../../controllers/supervisorController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    require_once(ROOT."Connection.php");

    $supervisorController = new SupervisorController();
    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();
    $studentId = $_SESSION["student_id"]; 

    if (isset($_GET['approve'])) {
        $reportId = stripslashes($_REQUEST['approve']);  
        $reportId = mysqli_real_escape_string($con, $reportId);

        $supervisorController->approveReport($reportId);
        header("Location: reports.php?id=$studentId");
        die();

    }elseif(isset($_GET['reject'])){
        $reportId = stripslashes($_REQUEST['reject']);  
        $reportId = mysqli_real_escape_string($con, $reportId);

        $supervisorController->rejectReport($reportId);
        header("Location: reports.php?id=$studentId");
        die();
    }
    else{
        header("Location: reports.php?id=$studentId");
        die();
    }
?>