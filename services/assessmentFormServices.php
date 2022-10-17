<?php
require_once(A."AssessmentForm.php");

class AssessmentFormService{
    private $db;
    function __construct() { $this->db = new Connection("localhost", "root", "", "portal");}

    function createAssessmentForm($qn1,$qn2,$qn3,$qn4,$qn5,$qn6,$qn7,$qn8,$qn9,$comment,$studentId){
        $isCreated = false;
        $query = "INSERT into `assessment_form` ( `qn1`, `qn2`, `qn3`, `qn4`, `qn5`, `qn6`, `qn7`, `qn8`, `qn9`, `comment`, `student_id`) 
                                    VALUES ('$qn1', '$qn2', '$qn3', '$qn4', '$qn5', '$qn6', '$qn7', '$qn8', '$qn9', '$comment', '$studentId')";
        $con = $this->db->openConnection();
        if (mysqli_query($con, $query)) {
            $isCreated = True;
        } else {
            $isCreated = False;
        } 
        $con->close();

    return $isCreated;
    }

    function updateAssessmentForm($id,$qn1,$qn2,$qn3,$qn4,$qn5,$qn6,$qn7,$qn8,$qn9,$comment){
        $isUpdated = false;
        $query = "UPDATE  `assessment_form` SET `qn1`='$qn1', `qn2`='$qn2', `qn3`='$qn3', `qn4`='$qn4', `qn5`='$qn5', `qn6`='$qn6', `qn7`='$qn7', `qn8`='$qn8', `qn9`='$qn9', `comment`='$comment' WHERE `id`='$id'";
        $con = $this->db->openConnection();
        if (mysqli_query($con, $query)) {
            $isUpdated = True;
        } else {
            $isUpdated = False;
        } 
        $con->close();

    return $isUpdated;
    }
    
    function fetchAllAssessors() {
        $assessors = array();
        $con = $this->db->openConnection();
        
        $query = "SELECT * FROM `assesor`";
        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $assessor = new Assessor($row['id'],$row['first_name'],$row['last_name'],$row['reg_number'],$row['program'],$row['phone_number'],$row['email_address'],$row['physical_address']);
            array_push($assessors, $assessor);
            unset($assessor);
        }

        $con->close(); 
        return $assessors;
    }


    function getAssessmentFormByStudentId($studentId){
        $assessmentForms = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `assessment_form` WHERE `student_id` = '$studentId'";

        $result = mysqli_query($con, $query) or die(mysqli_error($con));

        while($row = $result->fetch_assoc()) {
            $assessmentForm = new AssessmentForm($row['id'],$row['qn1'],$row['qn2'],$row['qn3'],$row['qn4'],$row['qn5'],$row['qn6'],$row['qn7'],$row['qn8'],$row['qn9'],$row['comment'],$row['student_id']);
            array_push($assessmentForms, $assessmentForm);
            unset($assessmentForm);
        }

        if(empty($assessmentForms)){
            return $a = array();
        }
        $con->close(); 
        return $assessmentForms[0];
    }
}

?>