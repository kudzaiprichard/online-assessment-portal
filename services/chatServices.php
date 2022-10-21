<?php
define('AC',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/models/");
include(AC."Chat.php");
include(AC."Message.php");
class ChatServices{
    private $db;
    function __construct() {$this->db = new Connection("localhost", "root", "", "portal");}

    function fetchAllMessagesBySupervisorsId($id){
        $messages = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `message` WHERE `chat_id` ='$id'";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $message = new Message($row['id'],$row['user'],$row['message'],$row['status'],$row['chat_id'],$row['timestamp']);
            array_push($messages, $message);
            unset($message);
        }

        $con->close(); 
        return $messages;
    }

    function fetchAllMessagesByAssessorId($id){
        $messages = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `message` WHERE `chat_id` ='$id'";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $message = new Message($row['id'],$row['user'],$row['message'],$row['status'],$row['chat_id'],$row['timestamp']);
            array_push($messages, $message);
            unset($message);
        }

        $con->close(); 
        return $messages;
    }

    function fetchChatByAssessorId($assessorId){
        $chats = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `chat` WHERE `assessor_id` ='$assessorId'";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $chat = new Chat($row['id'],$row['assessor_id'],$row['supervisor_id']);
            array_push($chats, $chat);
            unset($chat);
        }

        $con->close(); 
        return $chats;
    }

    function fetchChatBySupervisorsId($id){
        $chats = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `chat` WHERE `supervisor_id` ='$id'";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $chat = new Chat($row['id'],$row['assessor_id'],$row['supervisor_id']);
            array_push($chats, $chat);
            unset($chat);
        }

        $con->close(); 
        return $chats;
    }

    function fetchChatById($id){
        $chats = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `chat` WHERE `id` ='$id'";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $chat = new Chat($row['id'],$row['assessor_id'],$row['supervisor_id']);
            array_push($chats, $chat);
            unset($chat);
        }

        $con->close(); 
        return $chats[0];
    }

    function sendMessage($chatId, $message, $user){
        $isSent = false;
        $query = "INSERT into `message` (user, message, chat_id) 
                                    VALUES ('$user', '$message', '$chatId')";
        $con = $this->db->openConnection();
        if (mysqli_query($con, $query)) {
            $isSent = True;
        } else {
            $isSent = False;
        } 
        $con->close();

        return $isSent;
    }

    function seen($id){
        $isSeen = false;
        $con = $this->db->openConnection();
        $query = "UPDATE `message` SET `status`='seen'
                                    WHERE `chat_id`='$id'";
        if (mysqli_query($con, $query)) {
            $isSeen = true;
        }
        $con->close(); 
        return $isSeen;
    }

    function updateUser($emailAddress,$user){
        $isUpdate = false;
        $con = $this->db->openConnection();
        $query = "UPDATE `message` SET `user`='$emailAddress'
                                    WHERE `user`='$user'";
        if (mysqli_query($con, $query)) {
            $isUpdate = true;
        }
        $con->close(); 
        return $isUpdate;
    }

    function createChat($supervisorId,$assessorId){
        $isCreated = false;
        $con = $this->db->openConnection();
        $chats = array();
        $query1 = "SELECT * FROM `chat` WHERE `assessor_id`='$assessorId' AND `supervisor_id` ='$supervisorId'";
        $result1 = mysqli_query($con, $query1);

        $rows2 = mysqli_num_rows($result1);
        if ($rows2 == 1) {
            while($row1 = $result1->fetch_assoc()) {
                $chat = new Chat($row1['id'],$row1['assessor_id'],$row1['supervisor_id']);
                array_push($chats, $chat);
                unset($chat);
            }
        }
        else {
            $query = "INSERT into `chat` (assessor_id, supervisor_id) 
                                    VALUES ('7', '6')";
            
            if(mysqli_query($con, $query)){
                $query12 = "SELECT * FROM `chat` WHERE `assessor_id`='$assessorId' AND `supervisor_id` ='$supervisorId'";
                $result12 = mysqli_query($con, $query12);
                while($row1 = $result12->fetch_assoc()) {
                    $chat = new Chat($row1['id'],$row1['assessor_id'],$row1['supervisor_id']);
                    array_push($chats, $chat);
                    unset($chat);
                }
            }
            
        }

        $con->close();
        return $chats[0]->getId();
    }
}
?>