<?php
session_start();
    require_once("../../../controllers/studentController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    define('PATH',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/");
    require_once(ROOT."Connection.php");

    $studentController = new StudentController();
    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();

    $assessorId = $_SESSION["assessor_id"];
    $supervisorId = $_SESSION["supervisor_id"];
    $studentId = $_SESSION["student_id"];

    $targetFolder = PATH . "uploads/";

    $path = $_FILES['report']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $base = pathinfo($path, PATHINFO_FILENAME);
    $report_name = $base.'_'.date("H_i_s").'.'.$ext;

    $targetFolder = $targetFolder . $report_name;

    if (isset($_POST['submit'])) {
        $title = stripslashes($_REQUEST['title']);  
        $title = mysqli_real_escape_string($con, $title); 

        move_uploaded_file($_FILES['report']['tmp_name'], $targetFolder);
        $studentController->addReport($report_name,$title,$studentId,$supervisorId,$assessorId);

        header("Location: reports.php?id=$studentId");
        die();

    }
    else{
        header("Location: reports.php?id=$studentId");
        die();
    }
?>