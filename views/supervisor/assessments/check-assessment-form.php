<?php
    require_once("../../../controllers/supervisorController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    require_once(ROOT."Connection.php");

    $supervisorController = new SupervisorController();
    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();
    ##TODO: check if the student has a assessment form and route him to create form or update form
    if (isset($_GET['id'])) {

        $studentId = stripslashes($_REQUEST['id']);  
        $studentId = (int) mysqli_real_escape_string($con, $studentId);

        if(empty($supervisorController->getAssessmentFormByStudentId($studentId))){
            header("Location: create-assessment-form.php?id=$studentId");
            die();
        }else{
            header("Location: update-assessment-form.php?id=$studentId");
            die();
        }

        header("Location: tasks.php?id=$studentId");
        die();
    }
    else{
        header("Location: tasks.php?id=$studentId");
        die();
    }
?>