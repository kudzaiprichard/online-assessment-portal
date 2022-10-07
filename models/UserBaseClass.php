<?php
class UserBaseClass {
    private $db; 

    private $id;
    private $emailAddress;
    private $password;
    private $accountType;

    function __construct($id, $emailAddress=null, $password=null, $accountType=null) {
        $this->id = $id;
        $this->emailAddress = $emailAddress;
        $this->password = $password;
        $this->accountType = $accountType;
    }

    function getId(){return $this->id;}
    function getEmailAddress(){return $this->emailAddress;}
    function getAccountType(){return $this->accountType;}
    function getPassword(){return $this->password;}

    function setId($id){$this->id = $id;}
    function setEmailAddress($emailAddress){$this->emailAddress = $emailAddress;}
    function setAccountType($accountType){$this->accountType = $accountType;}
    function setPassword($password){$this->password = $password;}
}

?>