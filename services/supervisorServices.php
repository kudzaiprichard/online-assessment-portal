<?php
define('Z',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/models/");
require_once(Z."Supervisor.php");
class SupervisorService{
    private $db;
    function __construct() { $this->db = new Connection("localhost", "root", "", "portal");}

    function saveSupervisor($firstName, $lastName, $position, $companyName, $phoneNumber, $ecNumber, $emailAddress) {
        $isCreated = false;
        $query = "INSERT into `supervisor` (first_name, last_name, position, company_name, phone_number, ec_number, email_address) 
                                    VALUES ('$firstName', '$lastName', '$position', '$companyName', 
                                            '$phoneNumber', '$ecNumber', '$emailAddress')";
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
            $supervisor = new Supervisor($row['id'],$row['first_name'],$row['last_name'],$row['position'],$row['company_name'],$row['email_address'],$row['ec_number'],$row['phone_number']);
            array_push($supervisors, $supervisor);
            unset($supervisor);
        }

        $con->close(); 
        return $supervisors;
    }

    function getSupervisorByStudentId($assessorId){
        $supervisors = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `supervisor` WHERE `id`='$assessorId'";

        $result = mysqli_query($con, $query)or die(mysqli_error($con));

        while($row = $result->fetch_assoc()) {
            $supervisor = new Supervisor($row['id'],$row['first_name'],$row['last_name'],$row['position'],$row['company_name'],$row['email_address'],$row['ec_number'],$row['phone_number']);
            array_push($supervisors, $supervisor);
            unset($supervisor);
        }

        $con->close(); 
        return $supervisors[0];
    }


    function getLoggedInUser($emailAddress) {
        $users = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `supervisor` WHERE `email_address` = '$emailAddress'";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $user = new Supervisor($row['id'],$row['first_name'],$row['last_name'],$row['position'],$row['company_name'],$row['email_address'],$row['ec_number'],$row['phone_number']);
            array_push($users, $user);
            unset($user);
        }

        $con->close(); 
        return $users[0];
    }

    function updateSupervisorById($supervisorId,$firstName,$lastName,$emailAddress,$companyName,$position,$mobileNumber) {
        $isUpdated = false;
        $query = "UPDATE `supervisor` SET `first_name`='$firstName', `last_name`='$lastName', `position`='$position', `company_name`='$companyName', `phone_number`='$mobileNumber', `email_address`='$emailAddress' WHERE `id`='$supervisorId'";
        $con = $this->db->openConnection();
        if (mysqli_query($con, $query)) {
            $isUpdated = True;
        }
        $con->close();

    return $isUpdated;
    }

    function deleteSupervisorById($id) {}

    static function getSupervisorById($id) {}
}
?>