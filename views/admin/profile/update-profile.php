<?php
    require_once("../../../controllers/adminController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    require_once(ROOT."Connection.php");
    $adminController = new AdminController();
    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();

    if (isset($_GET['email_address'])) {
        $id = stripslashes($_REQUEST['id']);  
        $id = (int) mysqli_real_escape_string($con, $id);

        $emailAddress = stripslashes($_REQUEST['email_address']);  
        $emailAddress = mysqli_real_escape_string($con, $emailAddress);

        $password = stripslashes($_REQUEST['password']);    
        $password = mysqli_real_escape_string($con, $password);

        $confirmPassword = stripslashes($_REQUEST['confirm_password']);    
        $confirmPassword = mysqli_real_escape_string($con, $confirmPassword);

        

        if($password == $confirmPassword){
            $adminController->updateUser($id,$emailAddress, $password);
            $msg = "Profile Updated successfully";
            header("Location: profile.php?$msg");
            die();
        }else{
            $msg = "Passwords don't match";
            header("Location: profile.php?$msg");
        }

    }else{
        $msg = "Failed To Update Profile!";
        header("Location: profile.php?$msg");
        die();
    }
?>