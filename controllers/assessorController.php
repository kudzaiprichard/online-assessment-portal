<?php
require_once('Connection.php');
define('R',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/services/");
require_once(R."assessorServices.php");
require_once(R."studentsServices.php");
require_once('adminController.php');
require_once(R.'supervisorServices.php');
require_once(R.'reportServices.php');
require_once(R.'chatServices.php');
require_once(R.'userServices.php');

class AssessorController extends AdminController{
    private $assessorService;
    private $studentsService;
    private $supervisorService;
    private $reportServices;
    private $chatServices;
    private $userServices;

    function __construct(){
        $this->assessorService = new AssessorService();
        $this->studentsService = new StudentsServices();
        $this->supervisorService = new SupervisorService();
        $this->reportServices = new ReportServices();
        $this->chatServices = new ChatServices();
        $this->userService = new UserServices();
    }
    
    function saveAssessor($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress) {
        return $this->assessorService->fetchAllAssessors($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress);
    }

    function fetchAllAssessors(){
        return $this->assessorService->fetchAllAssessors();
    }

    function getLoggedInAssessor($emailAddress){
        return $this->assessorService->getLoggedInAssessor($emailAddress);
    }

    function fetchStudentsByAssessorId($assessorId){
        return $this->studentsService->fetchStudentsByAssessorId($assessorId);
    }

    function getSupervisorByStudentId($assessorId){
        return $this->supervisorService->getSupervisorByStudentId($assessorId);
    }

    function fetchReportsByUserIdAndAssessorId($studentId,$assessorId){
        return $this->reportServices->fetchReportsByUserIdAndAssessorId($studentId,$assessorId);
    }

    function fetchChatByAssessorId($assessorId){
        return $this->chatServices->fetchChatByAssessorId($assessorId);
    }

    function fetchAllMessagesByAssessorId($id){
        return $this->chatServices->fetchAllMessagesByAssessorId($id);
    }

    function fetchSupervisorsById($id){
        return $this->supervisorService->getSupervisorByStudentId($id);
    }

    function fetchChatById($chatId){
        return $this->chatServices->fetchChatById($chatId);
    }

    function updateAssessorById($assessorId,$firstName,$lastName,$emailAddress,$physicalAddress,$newPassword,$program,$regNumber,$mobileNumber,$userId,$userEmail){
        $this->assessorService->updateAssessorById($assessorId,$firstName,$lastName,$emailAddress,$program,$regNumber,$mobileNumber,$physicalAddress);
        $this->chatServices->updateUser($emailAddress,$userEmail);
        $this->userService->updateUser($userId, $emailAddress,$newPassword);
    }
}

?>