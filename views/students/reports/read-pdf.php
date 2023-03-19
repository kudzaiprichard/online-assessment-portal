<?php
define('UPLOADS',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/uploads/");

if(isset($_GET['path'])){

    $filename = $_GET['path'];

    echo '<embed src="../../../uploads/'.$filename.'" width="800px" height="2100px" />';


}else{
    header("Location: reports.php?message=$message");
    $message = "Filename is not defined.";
}
?>