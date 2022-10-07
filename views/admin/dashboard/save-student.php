<?php
    require_once("../../../controllers/adminController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    require_once(ROOT."Connection.php");
    $adminController = new AdminController();
    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();

    if (isset($_GET['first_name'])) {
        $firstName = stripslashes($_REQUEST['first_name']);  
        $firstName = mysqli_real_escape_string($con, $firstName);

        $lastName = stripslashes($_REQUEST['last_name']);   
        $lastName = mysqli_real_escape_string($con, $lastName);

        $regNumber = stripslashes($_REQUEST['reg_number']);    
        $regNumber = mysqli_real_escape_string($con, $regNumber);

        $program = stripslashes($_REQUEST['program']);   
        $program = mysqli_real_escape_string($con, $program);

        $phoneNumber = stripslashes($_REQUEST['phone_number']);    
        $phoneNumber = mysqli_real_escape_string($con, $phoneNumber);

        $emailAddress = stripslashes($_REQUEST['email_address']);  
        $emailAddress = mysqli_real_escape_string($con, $emailAddress);

        $physicalAddress = stripslashes($_REQUEST['physical_address']);    
        $physicalAddress = mysqli_real_escape_string($con, $physicalAddress);

        $accountType = stripslashes($_REQUEST['account_type']);    
        $accountType = mysqli_real_escape_string($con, $accountType);

        // echo $physicalAddress;
        $adminController->addStudent($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress);
        $adminController->saveAsUser(true,null,$emailAddress,$accountType);

        $msg = "User Added successfully";
        header("Location: dashboard.php?$msg");
        die();

    }else{
        $msg = "Failed To Add!";
        header("Location: dashboard.php?$msg");
        die();
    }
?>