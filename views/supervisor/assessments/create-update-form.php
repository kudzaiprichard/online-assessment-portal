<?php
session_start();
    require_once("../../../controllers/supervisorController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    require_once(ROOT."Connection.php");

    $supervisorController = new SupervisorController();
    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();
    $studentId = $_SESSION["student_id"]; 

    if (isset($_GET['create'])) {
        $qn1 = stripslashes($_REQUEST['qn1']);  
        $qn1 = mysqli_real_escape_string($con, $qn1);

        $qn2 = stripslashes($_REQUEST['qn2']);  
        $qn2 = mysqli_real_escape_string($con, $qn2);

        $qn3 = stripslashes($_REQUEST['qn3']);  
        $qn3 = mysqli_real_escape_string($con, $qn3);

        $qn4 = stripslashes($_REQUEST['qn4']);  
        $qn4 = mysqli_real_escape_string($con, $qn4);

        $qn5 = stripslashes($_REQUEST['qn5']);  
        $qn5 = mysqli_real_escape_string($con, $qn5);

        $qn6 = stripslashes($_REQUEST['qn6']);  
        $qn6 = mysqli_real_escape_string($con, $qn6);

        $qn7 = stripslashes($_REQUEST['qn7']);  
        $qn7 = mysqli_real_escape_string($con, $qn7);

        $qn8 = stripslashes($_REQUEST['qn8']);  
        $qn8 = mysqli_real_escape_string($con, $qn8);

        $qn9 = stripslashes($_REQUEST['qn9']);  
        $qn9 = mysqli_real_escape_string($con, $qn9);

        $comment = stripslashes($_REQUEST['comment']);  
        $comment = mysqli_real_escape_string($con, $comment);

        $supervisorController->createAssessmentForm($qn1,$qn2,$qn3,$qn4,$qn5,$qn6,$qn7,$qn8,$qn9,$comment,$studentId);
        header("Location: update-assessment-form.php?id=$studentId");
        die();

    }elseif(isset($_GET['update'])){
        $id = stripslashes($_REQUEST['id']);  
        $id = mysqli_real_escape_string($con, $id);

        $qn1 = stripslashes($_REQUEST['qn1']);  
        $qn1 = mysqli_real_escape_string($con, $qn1);

        $qn2 = stripslashes($_REQUEST['qn2']);  
        $qn2 = mysqli_real_escape_string($con, $qn2);

        $qn3 = stripslashes($_REQUEST['qn3']);  
        $qn3 = mysqli_real_escape_string($con, $qn3);

        $qn4 = stripslashes($_REQUEST['qn4']);  
        $qn4 = mysqli_real_escape_string($con, $qn4);

        $qn5 = stripslashes($_REQUEST['qn5']);  
        $qn5 = mysqli_real_escape_string($con, $qn5);

        $qn6 = stripslashes($_REQUEST['qn6']);  
        $qn6 = mysqli_real_escape_string($con, $qn6);

        $qn7 = stripslashes($_REQUEST['qn7']);  
        $qn7 = mysqli_real_escape_string($con, $qn7);

        $qn8 = stripslashes($_REQUEST['qn8']);  
        $qn8 = mysqli_real_escape_string($con, $qn8);

        $qn9 = stripslashes($_REQUEST['qn9']);  
        $qn9 = mysqli_real_escape_string($con, $qn9);

        $comment = stripslashes($_REQUEST['comment']);  
        $comment = mysqli_real_escape_string($con, $comment);

        $supervisorController->updateAssessmentForm($id,$qn1,$qn2,$qn3,$qn4,$qn5,$qn6,$qn7,$qn8,$qn9,$comment);
        header("Location: update-assessment-form.php?id=$studentId");
        die();
    }
    else{
        header("Location: update-assessment-form.php?id=$studentId");
        die();
    }
?>