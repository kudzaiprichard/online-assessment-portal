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

    function __construct($id, $firstName, $lastName, $position, $companyName, $emailAddress, $phoneNumber) {
        $this->id = $id;
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

    function getId(){return $this->id;}
    function getFirstName(){return $this->firstName;}
    function getLastName(){return $this->lastName;}
    function getPosition(){return $this->position;}
    function getCompanyName(){return $this->companyName;}
    function getEmailAddress(){return $this->emailAddress;}
    function getPhoneNumber(){return $this->phoneNumber;}

    function setId($id){$this->id = $id;}
    function setFirstName($firstName){$this->firstName = $firstName;}
    function setLastName($lastName){$this->lastName = $lastName;}
    function setPosition($position){$this->position = $position;}
    function setCompanyName($companyName){$this->companyName = $companyName;}
    function setEmailAddress($emailAddress){$this->emailAddress = $emailAddress;}
    function setPhoneNumber($phoneNumber){$this->phoneNumber = $phoneNumber;}
}
?>