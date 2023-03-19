<?php
define('AX',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/models/");
include(AX."Task.php");
class TaskServices{
    private $db;
    function __construct(){$this->db = new Connection("localhost", "root", "", "portal");}

    function createTask($name,$description,$studentId,$status,$supervisorId){
        $isCreated = false;
        $query = "INSERT into `task` (name, description, status, students_id, supervisor_id) 
                                    VALUES ('$name', '$description', '$status', '$studentId','$supervisorId')";
        $con = $this->db->openConnection();
        if (mysqli_query($con, $query)) {
            $isCreated = True;
        } else {
            $isCreated = False;
        } 
        $con->close();

    return $isCreated;
    }

    function updateTask($taskId,$taskName,$summary,$comment,$rate){
        $isUpdated = false;
        $query = "UPDATE `task` SET `name`='$taskName', `description`='$summary', `supervisor_comment`='$comment', `rating`='$rate' WHERE `id`='$taskId' "; 
        $con = $this->db->openConnection();
        if (mysqli_query($con, $query) or die(mysqli_error($con))) {
            $isUpdated = True;
        } 
        $con->close();
    return $isUpdated;
    }

    function fetchAllTasksByStudentId($student_id,$supervisor_id){
        $tasks = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `task` WHERE `students_id` = '$student_id' AND `supervisor_id` = '$supervisor_id' ";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $task = new Task($row['id'],$row['name'],$row['description'],$row['status'],$row['student_comment'],$row['supervisor_comment'],$row['students_id'],$row['supervisor_id'],$row['timestamp'],$row['rating']);
            array_push($tasks, $task);
            unset($task);
        }

        $con->close(); 
        return $tasks;
    }

    function fetchTasksByStudentId($id){
        $tasks = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `task` WHERE `students_id` = '$id'";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $task = new Task($row['id'],$row['name'],$row['description'],$row['status'],$row['student_comment'],$row['supervisor_comment'],$row['students_id'],$row['supervisor_id'],$row['timestamp'],$row['rating']);
            array_push($tasks, $task);
            unset($task);
        }

        $con->close(); 
        return $tasks;
    }

    function fetchTasksBySupervisorId($supervisorId){
        $tasks = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `task` WHERE `supervisor_id` = '$supervisorId' ";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $task = new Task($row['id'],$row['name'],$row['description'],$row['status'],$row['student_comment'],$row['supervisor_comment'],$row['students_id'],$row['supervisor_id'],$row['timestamp'],$row['rating']);
            array_push($tasks, $task);
            unset($task);
        }

        $con->close(); 
        return $tasks;
    }

    function rateAndCommentTask($taskId,$comment,$rate){
        $isUpdated = false;
        $con = $this->db->openConnection();

        $query = "UPDATE `task` SET `supervisor_comment`='$comment', `rating`='$rate' WHERE `id`='$taskId'";
        
        if (mysqli_query($con, $query) or die(mysqli_error($con))) {
            $isUpdated = true;
        }

        $con->close(); 
        return $isUpdated;
    }

    function commentTask($taskId,$comment){
        $isUpdated = false;
        $con = $this->db->openConnection();

        $query = "UPDATE `task` SET `student_comment`='$comment', `status`='completed' WHERE `id`='$taskId'";
        
        if (mysqli_query($con, $query) or die(mysqli_error($con))) {
            $isUpdated = true;
        }

        $con->close(); 
        return $isUpdated;
    }

    function deleteTaskByTaskId($taskId){
        $isDeleted = false;
        $con = $this->db->openConnection();

        $query = "DELETE FROM `task` WHERE `id`='$taskId'";
        
        if (mysqli_query($con, $query) or die(mysqli_error($con))) {
            $isDeleted = true;
        }

        $con->close(); 
        return $isDeleted;
    }

    function fetchTaskById($taskId){
        $tasks = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `task` WHERE  `id` = '$taskId' ";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $task = new Task($row['id'],$row['name'],$row['description'],$row['status'],$row['student_comment'],$row['supervisor_comment'],$row['students_id'],$row['supervisor_id'],$row['timestamp'],$row['rating']);
            array_push($tasks, $task);
            unset($task);
        }

        $con->close(); 
        return $tasks[0];
    }

   

    function fetchAllTasks(){}
    function updateTaskById($id){}
}
?>