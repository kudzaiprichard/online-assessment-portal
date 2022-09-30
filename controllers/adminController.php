<?php
require('Connection.php');
define('R',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/services/");
include(R."userServices.php");
include(R."studentsServices.php");

class AdminController{

    function __construct() {} 

    function fetchAllUsers()
    {
        $userServices = new UserServices();
        return $userServices->fetchAllUsers();
    } 

    function deleteUser($emailAddress)
    {
        $userServices = new UserServices();
        return $userServices->deleteUser($emailAddress);
    } 

    function addStudent($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress)
    {
        $studentServices = new StudentsServices();
        return $studentServices->createStudent($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress);
    }

    function saveAsUser($isAdmin,$password=null,$emailAddress=null,$accountType=null)
    {
        $studentServices = new StudentsServices();
        return $studentServices->saveUser($isAdmin,$password,$emailAddress,$accountType);
    }

    function login($emailAddress,$password)
    {
        $userServices = new UserServices();
        return $userServices->login($emailAddress, $password);
    }

    function logout()
    {
        $userServices = new UserServices();
        return $userServices->logout();
    }

    function getLoggedInUser($emailAddress)
    {
        $userServices = new UserServices();
        return $userServices->getLoggedInUser($emailAddress);
    }

}
//works
?>