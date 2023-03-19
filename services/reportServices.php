<?php
define('L',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/models/");
include(L."Report.php");
class ReportServices{
    private $db;
    function __construct() { $this->db = new Connection("localhost", "root", "", "portal");}

    function fetchReportsByUserIdAndSupervisorId($student_id,$supervisor_id){
        $reports = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `report` WHERE `student_id` = '$student_id' AND `supervisor_id` = '$supervisor_id' ";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $report = new Report($row['id'],$row['report'],$row['title'],$row['status'],$row['student_id'],$row['supervisor_id'],$row['assessor_id']);
            array_push($reports, $report);
            unset($supervisor);
        }

        $con->close(); 
        return $reports;
    }

    function fetchReportsByUserIdAndAssessorId($studentId,$assessorId){
        $reports = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `report` WHERE `student_id` = '$studentId' AND `assessor_id` = '$assessorId' ";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $report = new Report($row['id'],$row['report'],$row['title'],$row['status'],$row['student_id'],$row['supervisor_id'],$row['assessor_id']);
            array_push($reports, $report);
            unset($report);
        }

        $con->close(); 
        return $reports;
    }

    function fetchReportsByStudentId($id){
        $reports = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `report` WHERE `student_id` = '$id'";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $report = new Report($row['id'],$row['report'],$row['title'],$row['status'],$row['student_id'],$row['supervisor_id'],$row['assessor_id']);
            array_push($reports, $report);
            unset($report);
        }

        $con->close(); 
        return $reports;
    }

    function approveReport($reportId){
        $approved = false;
        $con = $this->db->openConnection();

        $query = "UPDATE `report` SET `status`='accepted' WHERE `id`='$reportId'";
        
        if(mysqli_query($con, $query) or die(mysqli_error($con))) {
            $approved = true;
        }

        $con->close(); 
        return $approved;
    }
    
    function rejectReport($reportId){
        $approved = false;
        $con = $this->db->openConnection();

        $query = "UPDATE `report` SET `status`='rejected' WHERE `id`='$reportId'";
        
        if(mysqli_query($con, $query) or die(mysqli_error($con))) {
            $approved = true;
        }

        $con->close(); 
        return $approved;
    }

    function addReport($report,$title,$studentId,$supervisorId,$assessorId){
        $added = false;
        $con = $this->db->openConnection();

        $query = "INSERT INTO `report`( `report`, `title`, `student_id`, `supervisor_id`, `assessor_id`) 
                            VALUES ('$report', '$title', '$studentId', '$supervisorId', '$assessorId')";

        if(mysqli_query($con, $query) or die(mysqli_error($con))) {
            $added = true;
        }

        $con->close(); 
        return $added;
    }
}
?>