<?php
require('Connection.php');
define('R',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/services/");
include(R."assessorServices.php");

class AssessorController{
    private $assessorService;
    function __construct(){$this->assessorService = new AssessorService();}
    
    function saveAssessor($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress) {
        return $this->assessorService->fetchAllAssessors($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress);
    }

    function fetchAllAssessors(){
        return $this->assessorService->fetchAllAssessors();
    }

    function updateAssessorByEmail($id) {}

    function deleteAssessorById($emailAddress) {return $this->assessorService->deleteAssessorById($emailAddress);}

    function getAssessorByEmail($emailAddress) {return $this->assessorService->getAssessorByEmail($emailAddress);}
}

?>