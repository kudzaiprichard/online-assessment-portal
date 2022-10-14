<?php
require("../../../controllers/adminController.php");
$adminController = new AdminController();

if(isset($_GET['id'])){
    $user_email = $_GET['id'];
    $adminController->deleteUser($user_email);
    $msg = "User deleted successfully";
    header("Location: supervisor.php?$msg");
    die();
}else{
    $msg = "Failed to delete user";
    header("Location: supervisor.php?$msg");
    die();
}

?>