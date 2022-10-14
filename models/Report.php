<?php
class Report{
    private $id;
    private $report;
    private $title;
    private $approved;
    private $student;
    private $supervisor;
    private $assessor;

    function __construct($id, $report, $title, $approved, $student, $supervisor, $assessor){
        $this->id = $id;
        $this->report = $report;
        $this->title = $title;
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
    function getTitle(){return $this->title;}
    function getAssessor(){return $this->assessor;}

    function setId($id){$this->id = $id;}
    function setReport($report){$this->report = $report;}
    function setApproved($approved){$this->approved = $approved;}
    function setStudent($student){$this->student = $student;}
    function setSupervisor($supervisor){$this->supervisor = $supervisor;}
    function setTitle($title){$this->title = $title;}
    function setAssessor($assessor){$this->assessor = $assessor;}

}
?>