<?php
// require('Connection.php');
define('A',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/models/");
include(A."UserBaseClass.php");
class UserServices{
    private $db;
    function __construct() { $this->db = new Connection("localhost", "root", "", "portal");}

    function fetchAllUsers()
    {
        $users = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `user`";
        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $user = new UserBaseClass($row['id'],$row['email_address'],$row['password'],$row['account_type']);
            array_push($users, $user);
            unset($user);
        }

        $con->close(); 
        return $users;
    } 

    function deleteUser($emailAddress)
    {
        $con = $this->db->openConnection();
        $query = "DELETE FROM user WHERE email_address='$emailAddress'";
        $result = $con->query($query);

        //Delete data from the student also
        $query1 = "DELETE FROM student WHERE email_address='$emailAddress'";
        $result1 = $con->query($query1);

        //Delete data from the assessor also
        $query2 = "DELETE FROM assessor WHERE email_address='$emailAddress'";
        $result2 = $con->query($query2);

        //Delete data from the supervisor also
        $query3 = "DELETE FROM supervisor WHERE email_address='$emailAddress'";
        $result3 = $con->query($query3);
        $con->close();
    } 

    function saveUser($isAdmin,$password=null,$emailAddress=null,$accountType=null) {
        $isCreated = false;
        $con = $this->db->openConnection();

        if($isAdmin) {
            $query = "INSERT into `user` (email_address, password, account_type) 
                                    VALUES ('$emailAddress', '$password',  '$accountType')";
            if (mysqli_query($con, $query)) {
                $isCreated = True;
            } 
        }
        else{
            //Final creation of account were user sets his password
            //at html user interface we can show the other textbox when he inputs email
            $query = "SELECT * FROM `user` WHERE email_address='$emailAddress'";
            $result = mysqli_query($con, $query);
            $rows = mysqli_num_rows($result);

            if ($rows == 1) {
                // return $isFound = false;
                $query = "UPDATE `user` SET `password`='" . md5($password) . "'
                                    WHERE `email_address`='$emailAddress'";
                if (mysqli_query($con, $query)) {
                    $isCreated = True;
                }
            }
        }

        $con->close(); 
        return $isCreated;
    }
    
    function login($emailAddress, $password) {
        $con = $this->db->openConnection();
        $isLoggedIn = False;

        $query = "SELECT * FROM `user` WHERE `email_address`= '$emailAddress' AND `password` = '" . md5($password) . "'";
        $result = mysqli_query($con, $query);
        $rows = mysqli_num_rows($result);

        if ($rows == 1) {
            $isLoggedIn = True;
        }

        $con->close(); 
        return $isLoggedIn;
    }

    function logout() {
        return session_destroy();
    }

    function updatePassword($id, $password){
        $isUpdated = false;
        $con = $this->db->openConnection();
        $query = "UPDATE `user` SET `password`='" . md5($password) . "'
                                    WHERE `id`='$id'";
        if (mysqli_query($con, $query)) {
            $isUpdated = true;
        }
        $con->close(); 
        return $isUpdated;
    }

    function updateEmail($id, $emailAddress){
        $isUpdated = false;
        $con = $this->db->openConnection();
        $query = "UPDATE `user` SET `email_address`='$emailAddress'
                                    WHERE `id`='$id'";
        if (mysqli_query($con, $query)) {
            $isUpdated = true;
        } 
        $con->close(); 
        return $isUpdated;
    }

    function updateAccountType($id, $accountType){
        $isUpdated = false;
        $con = $this->db->openConnection();
        $query = "UPDATE `user` SET `account_type`='$accountType' 
                                    WHERE `id`='$id'";
        if (mysqli_query($con, $query)) {
            $isUpdated = true;
        } 
        $con->close(); 
        return $isUpdated;
    }

    function updateUser($id, $emailAddress,$password,$accountType){
        $isUpdated = false;
        $con = $this->db->openConnection();
        $query = "UPDATE `user` SET `email_address`='$emailAddress',
                                    `password`='" . md5($password) . "',
                                    `account_type`='$accountType' 
                                    WHERE `id`='$id'";
        if (mysqli_query($con, $query)) {
            $isUpdated = true;
        } 
        $con->close(); 
        return $isUpdated;
    }


    function getLoggedInUser($emailAddress) {
        $users = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `user` WHERE `email_address` = '$emailAddress'";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $user = new UserBaseClass($row['id'],$row['email_address'],$row['password'],$row['account_type']);
            array_push($users, $user);
            unset($user);
        }

        $con->close(); 
        return $users[0];
    }
}
?>