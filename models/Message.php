<?php
class Message{
    private $id;
    private $user;
    private $message;
    private $status;
    private $chat;
    private $timestamp;

    function __construct( $id, $user, $message, $status, $chat, $timestamp ){
        $this->id = $id;
        $this->user = $user;
        $this->message = $message;
        $this->status = $status;
        $this->chat = $chat;
        $this->timestamp = $timestamp;
    }

    function getId(){return $this->id;}
    function getUser(){return $this->user;}
    function getMessage(){return $this->message;}
    function getStatus(){return $this->status;}
    function getChat(){return $this->chat;}
    function getTimestamp(){return $this->timestamp;}

    function setId($id){$this->id = $id;}
    function setUser($user){$this->user = $user;}
    function setMessage($message){$this->message = $message;}
    function setStatus($status){$this->status = $status;}
    function setChat($chat){$this->supervisor = $chat;}
    function setTimestamp($timestamp){$this->timestamp = $timestamp;}
}
?>