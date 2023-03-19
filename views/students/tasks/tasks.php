<?php 
session_start();
if(!isset($_SESSION["email_address"])) {
    header("Location: ../../auth/signup.php");
    exit();
}

define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/views/");
include(ROOT."includes/header.inc.php");
require_once("../../../controllers/studentController.php");

$studentController = new StudentController();
$student = $studentController->getLoggedInStudentByEmail($_SESSION["email_address"]);
$tasks = $studentController->fetchTasksByStudentId($student->getId());
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
            <a
                href="#0"
                data-bs-toggle="collapse"
                data-bs-target="#ddmenu_1"
                aria-controls="ddmenu_1"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
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
            <a
                href="#0"
                data-bs-toggle="collapse"
                data-bs-target="#ddmenu"
                aria-controls="ddmenu"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22">
                    <path
                    d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z"
                    />
                </svg>
                </span>
                <span class="text">Assessment</span>
            </a>
            <ul id="ddmenu" class="collapse show dropdown-nav">
                <li>
                    <a href="../assessments/assessment-form.php">Assessment Form</a>
                </li>
                <li>
                    <a href="../reports/reports.php">Reports</a> </a>
                </li>
                <li>
                    <a href="tasks.php" class="active">Tasks</a> </a>
                </li>
            </ul>
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
                <h2>Tasks</h2>
            </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
            <div class="breadcrumb-wrapper mb-30">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="#0">Student</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                    Tasks
                    </li>
                </ol>
                </nav>
            </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
        </div>
        
        <div class="row">
            <div class="card-style mb-30">
                <h6 class="mb-10 row">
                    <div class="col">Tasks</div>
                </h6>
                <p class="text-sm mb-20">
                    Tasks for <b><?php echo $student->getFirstName() , ' ';  echo $student->getLastName(); ?></b>
                    <i><?php echo $student->getRegNumber();?></i>, <?php echo $student->getProgram();?>
                </p>
                <div class="table-wrapper table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <h6>Assigned Date</h6>
                                </th>
                                <th>
                                    <h6>Task</h6>
                                </th>
                                <th>
                                    <h6>Summary</h6>
                                </th>
                                <th>
                                    <h6>Status</h6>
                                </th>
                                <th>
                                    <h6>Student comment</h6>
                                </th>
                                <th>
                                    <h6>Supervisor comment</h6>
                                </th>
                                <th>
                                    <h6>Rating</h6>
                                </th>
                                <th>
                                    <h6>Action</h6>
                                </th>
                            </tr>
                            <!-- end table row-->
                        </thead>
                        <tbody>
                        <?php
                            foreach($tasks as $task){
                                if($task->getStudentComment() == ''){
                                    $task->setStudentComment('No Comment');
                                }
                                if($task->getSupervisorComment() == ''){
                                    $task->setSupervisorComment('No Comment');
                                }
                                echo '
                                <tr>
                                <td>
                                    <p>'.date('dS F Y', strtotime($task->getTimestamp())).'</p>
                                </td>
                                <td class="min-width">
                                    <p>'.$task->getName().'</p>
                                </td>
                                <td class="min-width">
                                    <p>'.$task->getDescription().'</p>
                                </td>
                                ';
                                if($task->getStatus() == 'completed'){
                                    echo '
                                    <td class="min-width">
                                    <span class="status-btn active-btn">'.$task->getStatus().'</span>
                                    </td>
                                    ';
                                }
                                if($task->getStatus() == 'pending'){
                                    echo '
                                    <td class="min-width">
                                    <span class="status-btn info-btn">'.$task->getStatus().'</span>
                                    </td>
                                    ';
                                }
                                echo '
                                <td class="min-width">
                                    <p>'.$task->getStudentComment().'</p>
                                </td>
                                <td class="min-width">
                                    <p>'.$task->getSupervisorComment().'</p>
                                </td>
                                <td class="max-width">
                                    <p>
                                ';
                                if($task->getRating() == 1){echo '<i class="lni lni-star-filled"></i>';}
                                if($task->getRating() == 2){for($i = 0; $i<2; $i++){echo '<i class="lni lni-star-filled"></i>';}}
                                if($task->getRating() == 3){for($i = 0; $i<3; $i++){echo '<i class="lni lni-star-filled"></i>';}}
                                if($task->getRating() == 4){for($i = 0; $i<4; $i++){echo '<i class="lni lni-star-filled"></i>';}}
                                if($task->getRating() == 5){for($i = 0; $i<5; $i++){echo '<i class="lni lni-star-filled"></i>';}}
                                if($task->getRating() == 0.5){echo '<i class="lni lni-star-filled"></i>';}
                                echo '
                                    </p>
                                </td>
                                <td>
                                    <div class="action justify-content-end">
                                        <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="lni lni-more-alt"></i>
                                        </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                                <li class="dropdown-item">
                                                    <a href="comment.php?id='.$task->getId().'" class="text-gray" >Mark Done & Comment</a>
                                                </li>
                                            </ul>
                                    </div>
                                </td>
                            </tr>
                                
                                ';
                            }
                        ?>
                        </tbody>
                    </table>
                    <!-- end table -->
                </div>
            </div>
        </div>
        <!-- End Row -->
    </section>
    <!-- ========== section end ========== -->

<!-- ========== footer start =========== -->
<?php include(ROOT."includes/footer.inc.php");?>
<!-- ========== footer end =========== -->
