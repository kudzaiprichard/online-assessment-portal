<?php
define('C',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/models/");
include(C."student.php");
require_once("userServices.php");
class StudentsServices extends UserServices{
    private $db;
    function __construct() {$this->db = new Connection("localhost", "root", "", "portal");}
    
    function createStudent($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress, $assessor_id, $supervisor_id)
    {
        $isCreated=false;
        $query = "INSERT into `student` (first_name, last_name, reg_number, program, phone_number, email_address, physical_address, assesor_id, supervisor_id) 
                                    VALUES ('$firstName', '$lastName', '$regNumber', '$program', 
                                            '$phoneNumber', '$emailAddress',  '$physicalAddress',  '$assessor_id',  '$supervisor_id')";
        $con = $this->db->openConnection();
        if (mysqli_query($con, $query)) {
            $isCreated = True;
        } else {
            $isCreated = False;
        } 
        $con->close();

    return $isCreated;
    }

    function fetchAllStudentsBySupervisorzId($id){
        $students = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `student` WHERE supervisor_id = '$id'";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $student = new Student($row['id'],$row['first_name'],$row['last_name'],$row['reg_number'],$row['program'],$row['phone_number'],$row['email_address'],$row['physical_address'],$row['assesor_id'],$row['supervisor_id']);
            array_push($students, $student);
            unset($student);
        }

        $con->close(); 
        return $students;
    }

    function fetchStudentsByAssessorId($assessorId){
        $students = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `student` WHERE assesor_id = '$assessorId'";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $student = new Student($row['id'],$row['first_name'],$row['last_name'],$row['reg_number'],$row['program'],$row['phone_number'],$row['email_address'],$row['physical_address'],$row['assesor_id'],$row['supervisor_id']);
            array_push($students, $student);
            unset($student);
        }

        $con->close(); 
        return $students;
    }

    function fetchAllStudents() {
        $students = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `student`";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $student = new Student($row['id'],$row['first_name'],$row['last_name'],$row['reg_number'],$row['program'],$row['phone_number'],$row['email_address'],$row['physical_address'],$row['assesor_id'],$row['supervisor_id']);
            array_push($students, $student);
            unset($student);
        }

        $con->close(); 
        return $students;
    }

    function fetchAllStudentsBySupervisor($supervisor_id){
        $students = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `student` WHERE `supervisor_id` ='$supervisor_id'";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $student = new Student($row['id'],$row['first_name'],$row['last_name'],$row['reg_number'],$row['program'],$row['phone_number'],$row['email_address'],$row['physical_address'],$row['assesor_id'],$row['supervisor_id']);
            array_push($students, $student);
            unset($student);
        }

        $con->close(); 
        return $students;
    }

    #TODO:update function
    function updateStudentByEmail($id) {

    }

    function deleteStudentByEmail($emailAddress) {
        $con = $this->db->openConnection();
        $query = "DELETE FROM student WHERE email_address='$emailAddress'";
        $result = $con->query($query);
        $con->close();
    }

    function getStudentByEmail($emailAddress) {
        $students = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `student` WHERE `email_address` = '$emailAddress'";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $student = new Student($row['id'],$row['first_name'],$row['last_name'],$row['reg_number'],$row['program'],$row['phone_number'],$row['email_address'],$row['physical_address'],$row['assessor'],$row['supervisor']);
            array_push($students, $student);
            unset($user);
        }

        $con->close(); 
        return $students[0];
    }

    function getLoggedInUserById($id) {
        $users = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `student` WHERE `id` = '$id'";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $user = new Student($row['id'],$row['first_name'],$row['last_name'],$row['reg_number'],$row['program'],$row['phone_number'],$row['email_address'],$row['physical_address'],$row['assesor_id'],$row['supervisor_id']);
            array_push($users, $user);
            unset($user);
        }
        if(empty($users)){
            $user = new Student(0,"No user selected"," "," "," "," "," "," "," "," ");
            array_push($users, $user);
            unset($user);
        }
        $con->close(); 
        return $users[0];
    }

    function getLoggedInStudentByEmail($emailAddress){
        $users = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `student` WHERE `email_address` = '$emailAddress'";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $user = new Student($row['id'],$row['first_name'],$row['last_name'],$row['reg_number'],$row['program'],$row['phone_number'],$row['email_address'],$row['physical_address'],$row['assesor_id'],$row['supervisor_id']);
            array_push($users, $user);
            unset($user);
        }
        if(empty($users)){
            $user = new Student(0,"No user selected"," "," "," "," "," "," "," "," ");
            array_push($users, $user);
            unset($user);
        }
        $con->close(); 
        return $users[0];
    }

    function updateStudentById($studentId,$firstName,$lastName,$emailAddress,$program,$regNumber,$mobileNumber,$physicalAddress) {
        $isUpdated = false;
        $query = "UPDATE `student` SET `first_name`='$firstName', `last_name`='$lastName', `reg_number`='$regNumber', `program`='$program', `phone_number`='$mobileNumber', `email_address`='$emailAddress', `physical_address`='$physicalAddress' WHERE `id`='$studentId'";
        $con = $this->db->openConnection();
        if (mysqli_query($con, $query)) {
            $isUpdated = True;
        }
        $con->close();

    return $isUpdated;
    }

}
?>