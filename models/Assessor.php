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
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->regNumber = $regNumber;
        $this->program = $program;
        $this->phoneNumber = $phoneNumber;
        $this->emailAddress = $emailAddress;
        $this->physicalAddress = $physicalAddress;
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

    function getId(){return $this->id;}
    function getFirstName(){return $this->firstName;}
    function getLastName(){return $this->lastName;}
    function getRegNumber(){return $this->regNumber;}
    function getProgram(){return $this->program;}
    function getPhoneNumber(){return $this->phoneNumber;}
    function getEmailAddress(){return $this->emailAddress;}
    function getPhysicalAddress(){return $this->physicalAddress;}

    function setId($id){$this->id = $id;}
    function setFirstName($firstName){$this->firstName = $firstName;}
    function setLastName($lastName){$this->lastName = $lastName;}
    function setRegNumber($regNumber){$this->regNumber = $regNumber;}
    function setProgram($program){$this->program = $program;}
    function setPhoneNumber($phoneNumber){$this->phoneNumber = $phoneNumber;}
    function setEmailAddress($emailAddress){$this->emailAddress = $emailAddress;}
    function setPhysicalAddress($physicalAddress){$this->physicalAddress = $physicalAddress;}
    
}

?>