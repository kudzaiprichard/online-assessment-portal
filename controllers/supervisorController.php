<?php
require_once("adminController.php");
include(R."taskServices.php");
include(R."reportServices.php");
// include(R."studentsServices.php");
// include(R."assessorServices.php");
// include(R."supervisorServices.php");

class SupervisorController extends AdminController{
    private $userServices;
    private $studentServices;
    private $assessorServices;
    private $supervisorServices;
    private $taskServices;

    function __construct() {
        $this->userServices = new UserServices();
        $this->studentServices = new StudentsServices();
        $this->assessorServices = new AssessorService();
        $this->supervisorServices = new supervisorService();
        $this->taskServices = new TaskServices();
        $this->reportServices = new ReportServices();
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

    function fetchAllStudentsBySupervisorzId($id){
        return $this->studentServices->fetchAllStudentsBySupervisorzId($id);
    }


    function getLoggedInUser($emailAddress)
    {
        $supervisorServices = new supervisorService();
        return $supervisorServices->getLoggedInUser($emailAddress);
    }

}

?>