<?php
define('D',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/models/");
define('RX',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/services/");
require_once(RX."userServices.php");
require_once(RX."studentsServices.php");
require_once(RX."assessorServices.php");
require_once(RX."supervisorServices.php");
require_once(RX."reportServices.php");
require_once(RX."taskServices.php");
require_once("Connection.php");

class StudentController{
    private $userServices;
    private $studentServices;
    private $assessorServices;
    private $reportServices;
    private $taskServices;

    function __construct() {
        $this->userServices = new UserServices();
        $this->studentServices = new StudentsServices();
        $this->assessorServices = new AssessorService();
        $this->reportServices = new ReportServices();
        $this->taskServices = new TaskServices();
    } 

    function createStudent($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress, $accountType)
    {
        $assessor = $this->assessorServices->getAssessorByEmail($emailAddress);
        $supervisor = $this->assessorServices->getAssessorByEmail($emailAddress);
        return $this->studentServices->createStudent($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress, $assessor->getId(), $supervisor->getId());
    }

    function deleteStudentByEmail($emailAddress) {return $this->deleteStudentByEmail($emailAddress);}

    function getLoggedInUserById($id){
        return $this->studentServices->getLoggedInUserById($id);
    }

    function getLoggedInStudentByEmail($emailAddress){
        return $this->studentServices->getLoggedInStudentByEmail($emailAddress);
    }

    function updateStudentById($studentId,$firstName,$lastName,$emailAddress,$physicalAddress,$newPassword,$program,$regNumber,$mobileNumber,$userId){
        $this->studentServices->updateStudentById($studentId,$firstName,$lastName,$emailAddress,$program,$regNumber,$mobileNumber,$physicalAddress);
        $this->userServices->updateUser($userId, $emailAddress,$newPassword);
    }

    function fetchReportsByStudentId($id){
        return $this->reportServices->fetchReportsByStudentId($id);
    }

    function fetchTasksByStudentId($id){
        return $this->taskServices->fetchTasksByStudentId($id);
    }

    function commentTask($taskId,$comment){
        return $this->taskServices->commentTask($taskId,$comment);
    }

    function addReport($report,$title,$studentId,$supervisorId,$assessorId){
        $this->reportServices->addReport($report,$title,$studentId,$supervisorId,$assessorId);
    }

}
?>