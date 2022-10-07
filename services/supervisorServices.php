<?php
// require('Connection.php');
define('A',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/models/");
include(A."UserBaseClass.php");
class SupervisorService{
    private $db;
    function __construct() { $this->db = new Connection("localhost", "root", "", "portal");}

    function saveSupervisor() {
        $isCreated = false;
        $query = "INSERT into `supervisor` (first_name, last_name, position, company_name, phone_number, email_address) 
                                    VALUES ('$this->firstName', '$this->lastName', '$this->position', '$this->companyName', 
                                            '$this->phoneNumber', '$this->emailAddress')";
        $con = $this->db->openConnection();
        if (mysqli_query($con, $query)) {
            $isCreated = True;
        } else {
            $isCreated = False;
        } 
        $con->close();

    return $isCreated;
    }
    
    static function fetchSupervisors() {}

    function updateSupervisorById($id) {}

    function deleteSupervisorById($id) {}

    static function getSupervisorById($id) {}
}
?>