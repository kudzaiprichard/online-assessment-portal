<?php
class Assessor{
    private $db; 
    private $id;
    private $firstName;
    private $lastName;
    private $regNumber;
    private $program;
    private $phoneNumber;
    private $emailAddress;
    private $physicalAddress;

    function __construct($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress, $accountType) {
        parent::__construct($emailAddress,$password=null,$accountType);
        super($emailAddress,$password,$accountType);
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->regNumber = $regNumber;
        $this->program = $program;
        $this->phoneNumber = $phoneNumber;
        $this->emailAddress = $emailAddress;
        $this->physicalAddress = $physicalAddress;
        $this->db = new Connection("localhost", "root", "", "portal");
    }


    function __toString() {
        $output = "<h2>User id: $this->id</h2>\n" .
            "<h2>First Name: $this->firstName</h2>\n" .
            "<h2>Last Name: $this->lastName</h2>\n" .
            "<h2>Reg Number: $this->regNumber</h2>\n" .
            "<h2>Program: $this->program</h2>\n" .
            "<h2>Phone Number: $this->phoneNumber</h2>\n" .
            "<h2>Email Address: $this->emailAddress</h2>\n" .
            "<h2>Physical Address: $this->physicalAddress</h2>\n";
    return $output;
    }

    function saveAssessor() {
        $isCreated;
        $query = "INSERT into `student` (first_name, last_name, reg_number, program, phone_number, email_address, physical_address) 
                                    VALUES ('$this->firstName', '$this->lastName', '$this->regNumber', '$this->program', 
                                            '$this->phoneNumber', '$this->emailAddress',  '$this->physicalAddress')";
        $con = $this->db->openConnection();
        if (mysqli_query($con, $query)) {
            $isCreated = True;
        } else {
            $isCreated = False;
        } 
        $con->close();

    return $isCreated;
    }
    
    static function fetchAssessors() {}

    function updateAssessorById($id) {}

    function deleteAssessorById($id) {}

    static function getAssessorById($id) {}
}

?>