<?php
session_start();
    require_once("../../../controllers/supervisorController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    require_once(ROOT."Connection.php");

    $supervisorController = new SupervisorController();
    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();

    $supervisorId = $_SESSION["supervisor_id"];
    $userId = $_SESSION["user_id"];
    $userEmail = $_SESSION["email_address"];
    if (isset($_GET['submit'])) {
        $firstName = stripslashes($_REQUEST['first_name']);  
        $firstName = mysqli_real_escape_string($con, $firstName);

        $lastName = stripslashes($_REQUEST['last_name']);  
        $lastName = mysqli_real_escape_string($con, $lastName);

        $emailAddress = stripslashes($_REQUEST['email_address']);  
        $emailAddress = mysqli_real_escape_string($con, $emailAddress);

        $password = stripslashes($_REQUEST['password']);  
        $password = mysqli_real_escape_string($con, $password);

        $companyName = stripslashes($_REQUEST['company_name']);  
        $companyName = mysqli_real_escape_string($con, $companyName);

        $position = stripslashes($_REQUEST['position']);  
        $position = mysqli_real_escape_string($con, $position);

        $mobileNumber = stripslashes($_REQUEST['mobile_number']);  
        $mobileNumber = mysqli_real_escape_string($con, $mobileNumber);

        $supervisorController->updateSupervisorById($supervisorId,$firstName,$lastName,$emailAddress,$companyName,$position,$mobileNumber,$password,$userId,$userEmail);
        header("Location: profile.php?id=$supervisorId");
        die();

    }
    else{
        header("Location: profile.php?id=$supervisorId");
        die();
    }
?>