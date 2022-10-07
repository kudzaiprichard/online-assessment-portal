<?php
class Report{
    private $id;
    private $report;
    private $approved;
    private $student;
    private $supervisor;
    private $assessor;

    function __construct($id, $report, $approved, $student, $supervisor, $assessor){
        $this->id = $id;
        $this->report = $report;
        $this->approved = $approved;
        $this->student = $student;
        $this->supervisor = $supervisor;
        $this->assessor = $assessor;
    }

    function getId(){return $this->id;}
    function getReport(){return $this->report;}
    function getApproved(){return $this->approved;}
    function getStudent(){return $this->student;}
    function getSupervisor(){return $this->supervisor;}
    function getAssessor(){return $this->assessor;}

    function setId($id){$this->id = $id;}
    function setReport($report){$this->report = $report;}
    function setApproved($approved){$this->approved = $approved;}
    function setStudent($student){$this->student = $student;}
    function setSupervisor($supervisor){$this->supervisor = $supervisor;}
    function setAssessor($assessor){$this->assessor = $assessor;}

}
?>