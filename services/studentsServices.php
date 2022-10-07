<?php
define('C',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/models/");
include(C."student.php");
// require("userServices.php");
class StudentsServices extends UserServices{
    private $db;
    function __construct() {$this->db = new Connection("localhost", "root", "", "portal");}
    
    function createStudent($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress, $assesor_id, $supervisor_id)
    {
        $isCreated=false;
        $query = "INSERT into `student` (first_name, last_name, reg_number, program, phone_number, email_address, physical_address, assesor_id, supervisor_id) 
                                    VALUES ('$firstName', '$lastName', '$regNumber', '$program', 
                                            '$phoneNumber', '$emailAddress',  '$physicalAddress',  '$assesor_id',  '$supervisor_id')";
        $con = $this->db->openConnection();
        if (mysqli_query($con, $query)) {
            $isCreated = True;
        } else {
            $isCreated = False;
        } 
        $con->close();

    return $isCreated;
    }

    function fetchStudents() {
        $students = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `student`";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $student = new Student($row['id'],$row['first_name'],$row['last_name'],$row['reg_number'],$row['program'],$row['phone_number'],$row['email_address'],$row['physical_address'],$row['assessor_id'],$row['supervisor_id']);
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

}
?>