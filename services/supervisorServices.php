<?php
define('Z',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/models/");
require_once(Z."Supervisor.php");
class SupervisorService{
    private $db;
    function __construct() { $this->db = new Connection("localhost", "root", "", "portal");}

    function saveSupervisor($firstName, $lastName, $position, $companyName, $phoneNumber, $emailAddress) {
        $isCreated = false;
        $query = "INSERT into `supervisor` (first_name, last_name, position, company_name, phone_number, email_address) 
                                    VALUES ('$firstName', '$lastName', '$position', '$companyName', 
                                            '$phoneNumber', '$emailAddress')";
        $con = $this->db->openConnection();
        if (mysqli_query($con, $query)) {
            $isCreated = True;
        } else {
            $isCreated = False;
        } 
        $con->close();

    return $isCreated;
    }
    
    function fetchAllSupervisors() {
        $supervisors = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `supervisor`";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $supervisor = new Supervisor($row['id'],$row['first_name'],$row['last_name'],$row['position'],$row['company_name'],$row['email_address'],$row['phone_number']);
            array_push($supervisors, $supervisor);
            unset($supervisor);
        }

        $con->close(); 
        return $supervisors;
    }

    function getLoggedInUser($emailAddress) {
        $users = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `supervisor` WHERE `email_address` = '$emailAddress'";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $user = new Supervisor($row['id'],$row['first_name'],$row['last_name'],$row['position'],$row['company_name'],$row['email_address'],$row['phone_number']);
            array_push($users, $user);
            unset($user);
        }

        $con->close(); 
        return $users[0];
    }

    function updateSupervisorById($id) {}

    function deleteSupervisorById($id) {}

    static function getSupervisorById($id) {}
}
?>