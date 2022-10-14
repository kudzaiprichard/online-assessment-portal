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

        $position = stripslashes($_REQUEST['position']);    
        $position = mysqli_real_escape_string($con, $position);

        $companyName = stripslashes($_REQUEST['company_name']);   
        $companyName = mysqli_real_escape_string($con, $companyName);

        $phoneNumber = stripslashes($_REQUEST['phone_number']);    
        $phoneNumber = mysqli_real_escape_string($con, $phoneNumber);

        $emailAddress = stripslashes($_REQUEST['email_address']);  
        $emailAddress = mysqli_real_escape_string($con, $emailAddress);

        $accountType = stripslashes($_REQUEST['account_type']);    
        $accountType = mysqli_real_escape_string($con, $accountType);

        // echo $physicalAddress;
        $adminController->addSupervisor($firstName, $lastName, $position, $companyName, $phoneNumber, $emailAddress);
        $adminController->saveAsUser(true,null,$emailAddress,$accountType);

        $msg = "User Added successfully";
        header("Location: supervisor.php?$msg");
        die();

    }else{
        $msg = "Failed To Add!";
        header("Location: supervisor.php?$msg");
        die();
    }
?>