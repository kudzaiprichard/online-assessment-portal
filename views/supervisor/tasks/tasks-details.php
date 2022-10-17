<?php 
session_start();
if(!isset($_SESSION["email_address"])) {
    header("Location: ../../auth/signup.php");
    exit();
}
require_once("../../../controllers/supervisorController.php");
require_once("../../../controllers/studentController.php");
// require_once("../../controllers/studentController.php");
define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/views/");
include(ROOT."includes/header.inc.php");
// include(ROOT."includes/side-bar.inc.php");
if(isset($_GET['id'])){
    $studentId = $_GET['id'];
    $supervisorController = new SupervisorController();
    $studentController = new StudentController();
    $supervisor = $supervisorController->getLoggedInUser($_SESSION["email_address"]);
    $tasks = $supervisorController->fetchTasksByUserIdAndSupervisorId($studentId,$supervisor->getId());
    $student = $studentController->getLoggedInUserById($studentId);
    $_SESSION["student_id"] = $studentId;
}
?>

<!-- ======== sidebar-nav start =========== -->
<aside class="sidebar-nav-wrapper">
<div class="navbar-logo mb-5 mt-3">
<a href="index.html">
    <h2><small>AA PORTAL</small></h2>
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
                <span class="text">Students</span>
            </a>
            <ul id="ddmenu" class="collapse show dropdown-nav">
                <li>
                    <a href="../assessments/assessment-form.php">Assessment Forms</a>
                </li>
                <li>
                    <a href="../reports/reports.php" >Reports </a>
                </li>
                <li>
                    <a href="tasks.php" class="active">Tasks </a>
                </li>
            </ul>
        </li> 
        <li class="nav-item">
        <a href="../messages/messages.php">
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
            <span class="text">Messages</span>
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
                <h2>Tasks</h2>
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
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <h6 class="mb-10 row">
                                <div class="col">Tasks</div>
                                <div class="col">
                                    <a href="" class="btn btn-outline-primary float-end" data-bs-toggle="modal" data-bs-target="#modalId">Add Task</a>
                                </div>
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
                                                            <a href="comment-rate-form.php?id='.$task->getId().'" class="text-gray" >Comment & Rate</a>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <a href="delete-task.php?id='.$task->getId().'" class="text-gray">Remove</a>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <a href="edit-task-form.php?id='.$task->getId().'" class="text-gray">Edit</a>
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
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
    </section>
    <!-- ========== section end ========== -->

<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="row g-3 needs-validation" action="add-task.php" novalidate>
                <div class="modal-body">
                    <div class="col m-2 p-2">
                        <label for="validationCustom01" class="form-label">Task Name</label>
                        <input type="text" class="form-control" id="validationCustom01" name="name" required>
                    </div>
                    <div class="col m-2 p-2">
                        <label for="validationCustom01" class="form-label">Task Description</label>
                        <input type="text" class="form-control" id="validationCustom01" name="description" required>
                    </div>
                    <div class="col m-2 p-2 visually-hidden">
                        <label for="validationCustom01" class="form-label">Student</label>
                        <?php echo'<input type="text" class="form-control" id="validationCustom01" name="student" value="'.$studentId.'"required>';?>
                    </div>
                    <div class="col m-2 p-2 visually-hidden">
                        <label for="validationCustom01" class="form-label">Status</label>
                        <input type="text" class="form-control" id="validationCustom01" name="status"  value="pending" required>
                    </div>
                    <div class="col m-2 p-2 visually-hidden">
                        <label for="validationCustom01" class="form-label">Supervisor</label>
                        <?php echo'<input type="text" class="form-control" id="validationCustom01" name="supervisor" value="'.$supervisor->getId().'" required>';?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add">Add</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- Button trigger modal -->
<!-- ========== footer start =========== -->
<?php include(ROOT."includes/footer.inc.php");?>
<!-- ========== footer end =========== -->
