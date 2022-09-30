<?php
define('D',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/models/");
include(D."Student.php");

class StudentController{
    private $admin;
    private $db; 

    function __construct() {} 

    function addStudent($firstName, $lastName, $regNumber, $program, $phoneNumber, $emailAddress, $physicalAddress, $accountType)
    {
        $student = new Student("fsfs","xcvxv","xcvxcv","fgfdhe","bdfbxb","dfgrgr","sfbdfb","dfgdgergd");
        $student->saveStudent();
        $student->saveUser(true);
    }

}
// $a = new StudentController;
// $a->addStudent();
?>