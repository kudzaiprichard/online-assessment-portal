<?php
require("../../controllers/adminController.php");
$adminController = new AdminController();


$user_email = $_GET['id'];
$adminController->logout();

$msg = "Logged out successfully";
header("Location: signin/signin.php?$msg");
die();

?>