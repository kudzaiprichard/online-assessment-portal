<?php 
session_start();
if(!isset($_SESSION["email_address"])) {
    header("Location: ../../auth/signup.php");
    exit();
}
require_once("../../../controllers/adminController.php");
require_once("../../../controllers/studentController.php");
require_once("../../../controllers/supervisorController.php");
require_once("../../../controllers/assessorController.php");

define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/views/");
include(ROOT."includes/header.inc.php");
// include(ROOT."includes/side-bar.inc.php");

if(isset($_GET['id'])){$studentId = $_GET['id'];}else{$studentId = 0;}

$supervisorController = new SupervisorController();
$studentController = new StudentController();
$assessorController = new AssessorController();

$assessor = $assessorController->getLoggedInAssessor($_SESSION["email_address"]);
$students = $assessorController->fetchStudentsByAssessorId($assessor->getId());

$reports = $assessorController->fetchReportsByUserIdAndAssessorId($studentId,$assessor->getId());
$student = $studentController->getLoggedInUserById($studentId);
// $_SESSION["student_id"] = $studentId;
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
                    <a href="reports.php" class="active">Reports </a>
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
                <h2>Reports</h2>
            </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
            <div class="breadcrumb-wrapper mb-30">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="#0">Assessor</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                    Reports
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
            <div class="col-3 card-style mr-3 scroll">
                <h5>Students</h5>
                <div class=" mb-30">
                    <div class="table-wrapper table-responsive">
                        <p class="text-sm mb-20">
                            Students being assessed by you.
                        </p>
                        <table class="table striped-table">
                            <thead>
                                <tr>
                                    <th>
                                        <h6>Last Name</h6>
                                    </th>
                                    <th>
                                        <h6>Reg Number</h6>
                                    </th>
                                </tr>
                                <!-- end table row-->
                            </thead>
                            <tbody>
                                <?php foreach($students as $student){
                                    echo '
                                    <tr>
                                    <td>
                                        <a href="reports.php?id='.$student->getId().'">
                                            <p>'.$student->getFirstName().'</p>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="reports.php?id='.$student->getId().'">
                                            <p>'.$student->getLastName().'</p>
                                        </a>
                                    </td>
                                </tr>
                                <!-- end table row -->
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
            <div class="col card-style ml-5 scroll">
                <h5>Reports Summary</h5>
                <div class="mb-30">
                    <div class="row">
                        <div class="col-10">
                        <p class="text-sm mb-20">
                            For <b><?php
                                $student = $studentController->getLoggedInUserById($studentId);
                                echo $student->getFirstName(), " "; echo $student->getLastName();
                                ?></b>. click task to see details
                        </p>
                        </div>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <h6>Title</h6>
                                    </th>
                                    <th>
                                        <h6>Report</h6>
                                    </th>
                                    <th>
                                    </th>
                                </tr>
                                <!-- end table row-->
                            </thead>
                            <tbody>
                                <?php
                                $view = true;
                                    foreach($reports as $report){
                                        if($report->getApproved() != "rejected"){
                                            $view = false;
                                            echo '
                                            <tr>
                                            <td class="min-width">
                                                <p>
                                                    <a href="tasks-details.php">'.$report->getTitle().'</a>
                                                </p>
                                            </td>
                                            <td class="min-width">
                                                <p>
                                                    <a href="tasks-details.php">'.$report->getReport().'</a>
                                                </p>
                                            </td>
                                        ';
                                        echo'
                                            <td class="min-width">
                                                <div class="action justify-content-end">
                                                    
                                                    <button class="edit">
                                                        <i class="lni lni-eye"></i>
                                                    </button>
                                                    <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="lni lni-more-alt"></i>
                                                    </button>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                                            <li class="dropdown-item">
                                                                <a href="approve-reject-report.php?approve='.$report->getId().'" class="text-gray">download</a>
                                                            </li>
                                                        </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- end table row -->
                                        ';
                                        }
                                    }
                                    if($view){
                                        echo '
                                            <tr>
                                            <td class="min-width">
                                                <p>
                                                    <a href="tasks-details.php">No Report</a>
                                                </p>
                                            </td>
                                            <td class="min-width">
                                                <p>
                                                    <a href="tasks-details.php">No Report</a>
                                                </p>
                                            </td>
                                        ';
                                    }
                                ?>
                            </tbody>
                        </table>
                        <!-- end table -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </section>
    <!-- ========== section end ========== -->

<!-- ========== footer start =========== -->
<?php include(ROOT."includes/footer.inc.php");?>
<!-- ========== footer end =========== -->
