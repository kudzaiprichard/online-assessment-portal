<?php
class Supervisor{
    private $db; 
    private $id;
    private $firstName;
    private $lastName;
    private $position;
    private $companyName;
    private $emailAddress;
    private $phoneNumber;

    function __construct($firstName, $lastName, $position, $companyName, $emailAddress, $phoneNumber,$accountType) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->position = $position;
        $this->companyName = $companyName;
        $this->phoneNumber = $phoneNumber;
        $this->emailAddress = $emailAddress;
    }

    function __toString() {
        $output = "<h2>User id: $this->id</h2>\n" .
            "<h2>First Name: $this->firstName</h2>\n" .
            "<h2>Last Name: $this->lastName</h2>\n" .
            "<h2>Position: $this->position</h2>\n" .
            "<h2>Company Name: $this->companyName</h2>\n" .
            "<h2>Phone Number: $this->phoneNumber</h2>\n" .
            "<h2>Email Address: $this->emailAddress</h2>\n";
    return $output;
    }

    function saveSupervisor() {
        $isCreated;
        $query = "INSERT into `supervisor` (first_name, last_name, position, company_name, phone_number, email_address) 
                                    VALUES ('$this->firstName', '$this->lastName', '$this->position', '$company_name', 
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