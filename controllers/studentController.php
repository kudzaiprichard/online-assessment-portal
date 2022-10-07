<?php
define('D',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/models/");
define('R',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/services/");
include(R."userServices.php");

class StudentController{
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

    function createStudent($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress, $accountType)
    {
        $assessor = $this->assessorServices->getAssessorByEmail($emailAddress);
        $supervisor = $this->assessorServices->getAssessorByEmail($emailAddress);
        return $this->studentServices->createStudent($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress, $assessor->getId(), $supervisor->getId());
    }

    function deleteStudentByEmail($emailAddress) {return $this->deleteStudentByEmail($emailAddress);}

}
?>