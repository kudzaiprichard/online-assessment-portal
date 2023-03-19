<?php 
    session_start();
    if(!isset($_SESSION["email_address"])) {
        header("Location: ../../auth/signup/signup.php");
        exit();
    }
    require_once("../../../controllers/adminController.php");
    require_once("../../../controllers/studentController.php");
    require_once("../../../controllers/supervisorController.php");

    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/views/");
    include(ROOT."includes/header.inc.php");

    $supervisorController = new SupervisorController();
    $studentController = new StudentController();

    $supervisor = $supervisorController->getLoggedInUser($_SESSION["email_address"]);
    $chats = $supervisorController->fetchChatBySupervisorsId($supervisor->getId());
    $students = $supervisorController->fetchStudents($supervisor->getId());

?>

<!-- ======== sidebar-nav start =========== -->
<aside class="sidebar-nav-wrapper">
<div class="navbar-logo " >
    <a href="#">
        <img src="../../../assets/images/logo.jpg" alt="" class="img-fluid " width="120px;">
        <h4><small>ASSESSMENT PORTAL</small></h4>
    </a>
</div>
    <nav class="sidebar-nav">
        <ul>
            <li class="nav-item nav-item-has-children">
                <a href="#0" data-bs-toggle="collapse" data-bs-target="#ddmenu_1" aria-controls="ddmenu_1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon">
                    <svg width="22" height="22" viewBox="0 0 22 22">
                        <path
                        d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z"
                        />
                    </svg>
                </span>
                    <span class="text">Dashboard</span>
                </a>
                <ul id="ddmenu_1" class="collapse show dropdown-nav">
                    <li>
                        <a href="../dashboard/dashboard.php">Dashboard </a>
                    </li>
                    <li>
                        <a href="../profile/profile.php">Profile</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-item-has-children">
                <a href="#0" data-bs-toggle="collapse" data-bs-target="#ddmenu" aria-controls="ddmenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon">
                    <svg width="22" height="22" viewBox="0 0 22 22">
                        <path
                        d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z"
                        />
                    </svg>
                </span>
                    <span class="text">Students</span>
                </a>
                <ul id="ddmenu" class="collapse show dropdown-nav">
                    <li>
                        <a href="../assessments/assessment-form.php">Assessment Forms</a>
                    </li>
                    <li>
                        <a href="../reports/reports.php">Reports </a>
                    </li>
                    <li>
                        <a href="../tasks/tasks.php">Tasks </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="messages.php" class="active">
                    <span class="icon">
                <svg
                    width="22"
                    height="22"
                    viewBox="0 0 22 22"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                    d="M9.16667 19.25H12.8333C12.8333 20.2584 12.0083 21.0834 11 21.0834C9.99167 21.0834 9.16667 20.2584 9.16667 19.25ZM19.25 17.4167V18.3334H2.75V17.4167L4.58333 15.5834V10.0834C4.58333 7.24171 6.41667 4.76671 9.16667 3.94171V3.66671C9.16667 2.65837 9.99167 1.83337 11 1.83337C12.0083 1.83337 12.8333 2.65837 12.8333 3.66671V3.94171C15.5833 4.76671 17.4167 7.24171 17.4167 10.0834V15.5834L19.25 17.4167ZM15.5833 10.0834C15.5833 7.51671 13.5667 5.50004 11 5.50004C8.43333 5.50004 6.41667 7.51671 6.41667 10.0834V16.5H15.5833V10.0834Z"
                    />
                </svg>
                </span>
                    <span class="text" class="active">Messages</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
<div class="overlay"></div>
<!-- ======== end sidebar =========== -->

<!-- ======== main-wrapper start =========== -->
<main class="main-wrapper">
    <!-- ========== nav start ========== -->
    <?php include(ROOT."includes/navbar.inc.php");?>
    <!-- ========== nav end ========== -->
    <!-- ========== section start ========== -->
    <section class="section">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title mb-30">
                            <h2>Supervisor Messages</h2>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper mb-30">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#0">Supervisor</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Messages
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>

            <div class="card-style">
                <div class="row">
                    <div class="col">
                        <p class="text-sm mb-20">
                            <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalId">Start A New Chat</a>
                        </p>
                    </div>
                </div>
                <?php
                    foreach($chats as $chat){
                        $messages = $supervisorController->fetchAllMessagesBySupervisorsId($chat->getId());
                        foreach($messages as $message){
                            if($message->getUser() != $supervisor->getEmailAddress()){
                                if(strlen($message->getMessage())>120){
                                    $message->setMessage(substr($message->getMessage(),0,125));
                                }
                                if($message->getStatus() != "seen")
                                {echo '<div class="single-notification bg-purple-200 p-4 mb-3 rounded">
                                    <div class="checkbox">
                                        <div class="form-check checkbox-style mb-20">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox-1" checked/>';}
                                else{echo 
                                    '<div class="single-notification p-4 mb-3 rounded">
                                        <div class="checkbox">
                                        <div class="form-check checkbox-style mb-20">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox-1"/>
                                    ';}
                                echo '
                                        </div>
                                    </div>
                                    <div class="notification">
                                        <div class="image warning-bg">
                                            <span>W</span>
                                        </div>
                                        <a href="mark-as-read.php?id='.$chat->getId().'" class="content">
                                            <h6>'.$message->getUser().'</h6>
                                            <p class="text-sm text-gray">
                                                '.$message->getMessage().' 
                                            ';
                                        if(strlen($message->getMessage())>20){echo'<b>....</b>';}
                                        echo '
                                        </p>
                                            <span class="text-sm text-medium text-gray">25 min ago</span>
                                        </a>
                                    </div>
                                    <div class="action">
                                    <a class="delete-btn btn" href="delete.php?id='.$message->getId().'">
                                        <i class="lni lni-trash-can"></i>
                                    </a>
                                    <button class="more-btn dropdown-toggle" id="moreAction" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="lni lni-more-alt"></i>
                                    </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction">
                                            <li class="dropdown-item">
                                                <a href="mark-as-read.php?cid='.$chat->getId().'" class="text-gray">Mark as Read</a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="mark-as-read.php?id='.$chat->getId().'" class="text-gray">Reply</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            ';
                            }
                        }
                    }
                ?>

            </div>
    </section>
    <!-- ========== section end ========== -->

<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Click email to start chat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body list-group" >
                <?php
                    $email = "";
                    $assessors = array();
                    foreach($students as $student){
                        $assessor =  $supervisorController->fetchAssessorsById($student->getAssessor());
                        if($assessor->getEmailAddress() != $email){array_push($assessors,$assessor);}
                        $email = $assessor->getEmailAddress();
                        unset($assessor);
                    }
                    foreach($assessors as $assessor){
                        echo '
                        <div class="rounded card m-1 p-3">
                            <a href="start-chat.php?id='.$assessor->getId().'" class="text-dark">'.$assessor->getEmailAddress().'</a>
                        </div>
                        ';
                    }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Optional: Place to the bottom of scripts -->
<script>
    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)

</script>
    <!-- ========== footer start =========== -->
    <?php include(ROOT."includes/footer.inc.php");?>
    <!-- ========== footer end =========== -->