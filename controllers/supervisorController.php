<?php
define('RSS',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/services/");
require_once("adminController.php");
require_once(RSS."taskServices.php");
require_once(RSS."reportServices.php");
require_once(RSS."chatServices.php");
require_once(RSS."assessorServices.php");
require_once(RSS."assessmentFormServices.php");


class SupervisorController extends AdminController{
    private $userServices;
    private $studentServices;
    private $assessorServices;
    private $supervisorServices;
    private $taskServices;
    private $assessmentFormServices;
    private $chatServices;

    function __construct() {
        $this->userServices = new UserServices();
        $this->studentServices = new StudentsServices();
        $this->assessorServices = new AssessorService();
        $this->supervisorServices = new supervisorService();
        $this->taskServices = new TaskServices();
        $this->reportServices = new ReportServices();
        $this->chatServices = new ChatServices();
        $this->assessmentFormServices = new AssessmentFormService();
    }

    function fetchStudents($id){   
        return $this->studentServices->fetchAllStudentsBySupervisor($id);
    }

    function fetchTasksByUserIdAndSupervisorId($studentId,$supervisorId){   
        return $this->taskServices->fetchAllTasksByStudentId($studentId,$supervisorId);
    }

    function fetchReportsByUserIdAndSupervisorId($studentId,$supervisorId){   
        return $this->reportServices->fetchReportsByUserIdAndSupervisorId($studentId,$supervisorId);
    }

    function fetchAllStudentsBySupervisorsId($id){
        return $this->studentServices->fetchAllStudentsBySupervisorzId($id);
    }

    function fetchAllMessagesBySupervisorsId($id){
        return $this->chatServices->fetchAllMessagesBySupervisorsId($id);
    }

    function fetchChatBySupervisorsId($id){
        return $this->chatServices->fetchChatBySupervisorsId($id);
    }

    function fetchChatById($id){
        return $this->chatServices->fetchChatById($id);
    }

    function sendMessage($chatId, $message, $user){
        return $this->chatServices->sendMessage($chatId, $message, $user);
    }

    function messageSeen($id){
        return $this->chatServices->seen($id);
    }

    function fetchAssessorsById($id){
        return $this->assessorServices->fetchAssessorsById($id);
    }

    function createChat($supervisorId,$assessorId){
        return $this->chatServices->createChat($supervisorId,$assessorId);
    }

    function createTask($name,$description,$studentId,$status,$supervisorId){
        return $this->taskServices->createTask($name,$description,$studentId,$status,$supervisorId);
    }

    function rateAndCommentTask($taskId,$comment,$rate){
        return $this->taskServices->rateAndCommentTask($taskId,$comment,$rate);
    }

    function getAssessmentFormByStudentId($studentId){
        return $this->assessmentFormServices->getAssessmentFormByStudentId($studentId);
    }

    function getLoggedInUser($emailAddress)
    {
        $supervisorServices = new supervisorService();
        return $supervisorServices->getLoggedInUser($emailAddress);
    }

    function getLoggedUser($emailAddress)
    {
        $userServices = new UserServices();
        return $userServices->getLoggedInUser($emailAddress);
    }
    
    function deleteTaskByTaskId($taskId){
        return $this->taskServices->deleteTaskByTaskId($taskId);
    }

    function fetchTaskById($taskId){
        return $this->taskServices->fetchTaskById($taskId);
    }

    function updateTask($taskId,$taskName,$summary,$comment,$rate){
        return $this->taskServices->updateTask($taskId,$taskName,$summary,$comment,$rate);
    }

    function approveReport($reportId){
        return $this->reportServices->approveReport($reportId);
    }

    function rejectReport($reportId){
        return $this->reportServices->rejectReport($reportId);
    }

    function createAssessmentForm($qn1,$qn2,$qn3,$qn4,$qn5,$qn6,$qn7,$qn8,$qn9,$comment,$studentId){
        return $this->assessmentFormServices->createAssessmentForm($qn1,$qn2,$qn3,$qn4,$qn5,$qn6,$qn7,$qn8,$qn9,$comment,$studentId);
    }

    function updateAssessmentForm($id,$qn1,$qn2,$qn3,$qn4,$qn5,$qn6,$qn7,$qn8,$qn9,$comment){
        return $this->assessmentFormServices->updateAssessmentForm($id,$qn1,$qn2,$qn3,$qn4,$qn5,$qn6,$qn7,$qn8,$qn9,$comment);
    }

    function updateSupervisorById($supervisorId,$firstName,$lastName,$emailAddress,$companyName,$position,$mobileNumber,$password,$userId,$userEmail){
        $this->supervisorServices->updateSupervisorById($supervisorId,$firstName,$lastName,$emailAddress,$companyName,$position,$mobileNumber);
        $this->chatServices->updateUser($emailAddress,$userEmail);
        $this->userServices->updateUser($userId, $emailAddress,$password);
    }

    function fetchTasksBySupervisorId($supervisorId){
        return $this->taskServices->fetchTasksBySupervisorId($supervisorId);
    }

}

?>