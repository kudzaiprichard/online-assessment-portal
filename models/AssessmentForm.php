<?php
class AssessmentForm{
    private $id;
    private $qn1;
    private $qn2;
    private $qn3;
    private $qn4;
    private $qn5;
    private $qn6;
    private $qn7;
    private $qn8;
    private $qn9;
    private $comment;
    private $studentId;

    function __construct($id, $qn1, $qn2, $qn3, $qn4, $qn5, $qn6, $qn7, $qn8, $qn9, $comment, $studentId){
        $this->id = $id;
        $this->qn1 = $qn1;
        $this->qn2 = $qn2;
        $this->qn3 = $qn3;
        $this->qn4 = $qn4;
        $this->qn5 = $qn5;
        $this->qn6 = $qn6;
        $this->qn7 = $qn7;
        $this->qn8 = $qn8;
        $this->qn9 = $qn9;
        $this->comment = $comment;
        $this->$studentId = $studentId;
    }

    function getId(){return $this->id;}
    function getQn1(){return $this->qn1;}
    function getQn2(){return $this->qn2;}
    function getQn3(){return $this->qn3;}
    function getQn4(){return $this->qn4;}
    function getQn5(){return $this->qn5;}
    function getQn6(){return $this->qn6;}
    function getQn7(){return $this->qn7;}
    function getQn8(){return $this->qn8;}
    function getQn9(){return $this->qn9;}
    function getComment(){return $this->comment;}
    function getStudentId(){return $this->studentId;}

    function setId($id){$this->id = $id;}
    function setQn1($qn){$this->qn1 = $qn;}
    function setQn2($qn){$this->qn2 = $qn;}
    function setQn3($qn){$this->qn3 = $qn;}
    function setQn4($qn){$this->qn4 = $qn;}
    function setQn5($qn){$this->qn5 = $qn;}
    function setQn6($qn){$this->qn6 = $qn;}
    function setQn7($qn){$this->qn7 = $qn;}
    function setQn8($qn){$this->qn8 = $qn;}
    function setQn9($qn){$this->qn9 = $qn;}
    function setComment($comment){$this->comment = $comment;}
    function setStudentId($studentId){$this->studentId = $studentId;}

}
?>