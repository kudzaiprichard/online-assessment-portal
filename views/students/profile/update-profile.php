<?php
session_start();
    require_once("../../../controllers/studentController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    require_once(ROOT."Connection.php");

    $studentController = new StudentController();
    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();

    $studentId = $_SESSION["student_id"];
    $userId = $_SESSION["user_id"];
    $userEmail = $_SESSION["email_address"];

    if (isset($_GET['submit'])) {
        $firstName = stripslashes($_REQUEST['first_name']);  
        $firstName = mysqli_real_escape_string($con, $firstName);

        $lastName = stripslashes($_REQUEST['last_name']);  
        $lastName = mysqli_real_escape_string($con, $lastName);

        $emailAddress = stripslashes($_REQUEST['email_address']);  
        $emailAddress = mysqli_real_escape_string($con, $emailAddress);

        $newPassword = stripslashes($_REQUEST['new_password']);  
        $newPassword = mysqli_real_escape_string($con, $newPassword);

        $confirmPassword = stripslashes($_REQUEST['confirm_password']);  
        $confirmPassword = mysqli_real_escape_string($con, $confirmPassword);

        $program = stripslashes($_REQUEST['program']);  
        $program = mysqli_real_escape_string($con, $program);

        $regNumber = stripslashes($_REQUEST['reg_number']);  
        $regNumber = mysqli_real_escape_string($con, $regNumber);

        $mobileNumber = stripslashes($_REQUEST['mobile_number']);  
        $mobileNumber = mysqli_real_escape_string($con, $mobileNumber);

        $physicalAddress = stripslashes($_REQUEST['physical_address']);  
        $physicalAddress = mysqli_real_escape_string($con, $physicalAddress);

        if($newPassword == $confirmPassword){
            $studentController->updateStudentById($studentId,$firstName,$lastName,$emailAddress,$physicalAddress,$newPassword,$program,$regNumber,$mobileNumber,$userId);
            header("Location: profile.php?id=$studentId");
            die();
        }else{
            $_SESSION["message"] = "Passwords do not match";
            header("Location: profile.php?id=$studentId");
            die();
        }

    }
    else{
        $_SESSION["message"] = "Failed to update account";
        header("Location: profile.php?id=$studentId");
        die();
    }
?>