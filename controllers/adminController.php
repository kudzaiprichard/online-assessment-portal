<?php
require('Connection.php');
define('R',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/services/");
include(R."userServices.php");
include(R."studentsServices.php");
include(R."assessorServices.php");
include(R."supervisorServices.php");

class AdminController{
    private $userServices;
    private $studentServices;
    private $assessorServices;
    private $supervisorServices;

    function __construct() {
        $this->userServices = new UserServices();
        $this->studentServices = new StudentsServices();
        $this->assessorServices = new AssessorService();
        $this->supervisorServices = new supervisorService();
    } 

    function fetchAllUsers()
    {
        return $this->userServices->fetchAllUsers();
    } 

    function deleteUser($emailAddress)
    {
        return $this->userServices->deleteUser($emailAddress);
    } 

    function addStudent($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress)
    {
        $assessor = $this->assessorServices->getAssessorByEmail($emailAddress);
        $supervisor = $this->assessorServices->getAssessorByEmail($emailAddress);
        return $this->studentServices->createStudent($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress, $assessor->getId(), $supervisor->getId());
    }

    function saveAsUser($isAdmin,$password=null,$emailAddress=null,$accountType=null)
    {
        return $this->studentServices->saveUser($isAdmin,$password,$emailAddress,$accountType);
    }

    function login($emailAddress,$password)
    {
        return $this->userServices->login($emailAddress, $password);
    }

    function logout()
    {
        return $this->userServices->logout();
    }

    function getLoggedInUser($emailAddress)
    {
        return $this->userServices->getLoggedInUser($emailAddress);
    }

}

?>