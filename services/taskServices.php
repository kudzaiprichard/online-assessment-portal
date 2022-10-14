<?php
define('AX',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/models/");
include(AX."Task.php");
class TaskServices{
    private $db;
    function __construct(){$this->db = new Connection("localhost", "root", "", "portal");}

    function createTask($taskName, $taskDescription, $status, $student, $supervisor){}

    function fetchAllTasksByStudentId($student_id,$supervisor_id){
        $tasks = array();
        $con = $this->db->openConnection();
        $query = "SELECT * FROM `task` WHERE `students_id` = '$student_id' AND `supervisor_id` = '$supervisor_id' ";

        $result = mysqli_query($con, $query);

        while($row = $result->fetch_assoc()) {
            $task = new Task($row['id'],$row['name'],$row['description'],$row['status'],$row['student_comment'],$row['supervisor_comment'],$row['students_id'],$row['supervisor_id'],$row['timestamp'],$row['rating']);
            array_push($tasks, $task);
            unset($supervisor);
        }

        $con->close(); 
        return $tasks;
    }

    function fetchAllTasks(){}
    function deleteTaskById($id){}
    function updateTaskById($id){}
    function fetchTaskById($id){}
}
?>