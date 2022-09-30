<?php
define('C',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/models/");
include(C."student.php");
// require("userServices.php");
class StudentsServices extends UserServices{
    private $admin;
    private $db;
    private $student;

    function __construct() {
        parent::__construct();
        $this->db = new Connection("localhost", "root", "", "portal");
    }
    
    function createStudent($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress)
    {
        $isCreated;
        $query = "INSERT into `student` (first_name, last_name, reg_number, program, phone_number, email_address, physical_address) 
                                    VALUES ('$firstName', '$lastName', '$regNumber', '$program', 
                                            '$phoneNumber', '$emailAddress',  '$physicalAddress')";
        $con = $this->db->openConnection();
        if (mysqli_query($con, $query)) {
            $isCreated = True;
        } else {
            $isCreated = False;
        } 
        $con->close();

    return $isCreated;
    }

    static function fetchStudents() {}

    function updateStudentById($id) {}

    function deleteStudentById($id) {}

    static function getStudentById($id) {}

}
//works
$student = new StudentsServices();
// $student->createStudent("prichard", "matizirofa", "R191582L", "HAI", "0773403472", "prichard21@gmail.com", "cranborne");
// $student->saveUser(true,null,"prichard21@gmail.com","student");

//user registration
$student->saveUser(false,"nuttertools","prichard21@gmail.com",null);

?>