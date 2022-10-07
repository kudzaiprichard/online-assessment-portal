<?php
define('A',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/models/");
include(A."Task.php");
class TaskService{
    function createTask($taskName, $taskDescription, $status, $student, $supervisor){
        
    }

    function fetchAllTasks(){}
    function deleteTaskById($id){}
    function updateTaskById($id){}
    function fetchTaskById($id){}
}
?>