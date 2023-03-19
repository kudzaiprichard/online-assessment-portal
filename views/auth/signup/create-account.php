<?php
    require_once("../../../controllers/adminController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
    require_once(ROOT."Connection.php");
    $adminController = new AdminController();
    $db = new Connection("localhost", "root", "", "portal");
    $con = $db->openConnection();

    if (isset($_GET['email_address'])) {
        $emailAddress = stripslashes($_REQUEST['email_address']);  
        $emailAddress = mysqli_real_escape_string($con, $emailAddress);

        $password = stripslashes($_REQUEST['password']);  
        $password = mysqli_real_escape_string($con, $password);

        $confirmPassword = stripslashes($_REQUEST['confirm_password']);  
        $confirmPassword = mysqli_real_escape_string($con, $confirmPassword);


        if($password == $confirmPassword){
            if($adminController->saveAsUser(false,$password,$emailAddress,null)){
                $msg = "Account Registered successfully, you can procced to login";
                header("Location: ../signin/signin.php?msg=$msg");
                die();
            }else{
                $msg = "The email address used is not registered";
                header("Location: signup.php?msg=$msg");
                die();
            }
            
        }else{
            $msg = "Password and Confirm Password should match!";
            header("Location: signup.php?msg=$msg");
            die();
        }

    }
?>