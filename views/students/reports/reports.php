<?php 
session_start();
if(!isset($_SESSION["email_address"])) {
    header("Location: ../../auth/signup.php");
    exit();
}
define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/views/");
include(ROOT."includes/header.inc.php");
require_once("../../../controllers/studentController.php");
define('UPLOADS',$_SERVER['DOCUMENT_ROOT']."../../../uploads/");

$studentController = new StudentController();

$student = $studentController->getLoggedInStudentByEmail($_SESSION["email_address"]);
$reports = $studentController->fetchReportsByStudentId($student->getId());
$_SESSION["assessor_id"] = $student->getAssessor();
$_SESSION["supervisor_id"] = $student->getSupervisor();
$_SESSION["student_id"] = $student->getId();
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
                    <a href="reports.php" class="active">Reports</a> </a>
                </li>
                <li>
                    <a href="../tasks/tasks.php">Tasks </a>
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
                <h2>Reports</h2>
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
            <div class="col card-style ml-5 scroll">
                <h5>Reports Summary</h5>
                <div class="mb-30">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-lg float-end" data-bs-toggle="modal" data-bs-target="#modalId"><small>Upload Report</small></button>
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
                                        <h6>Status</h6>
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
                                                    <a href="#">'.$report->getTitle().'</a>
                                                </p>
                                            </td>
                                            <td class="min-width">
                                                <p>
                                                    <a href="#">'.$report->getReport().'</a>
                                                </p>
                                            </td>
                                        ';
                                        if($report->getApproved() == "rejected"){
                                            echo'
                                            <td class="min-width">
                                                <span class="status-btn close-btn">'.$report->getApproved().'</span>
                                            </td>
                                            ';
                                        }
                                        if($report->getApproved() == "accepted"){
                                            echo'
                                            <td class="min-width">
                                                <span class="status-btn success-btn">'.$report->getApproved().'</span>
                                            </td>
                                            ';
                                        }
                                        if($report->getApproved() == " " || $report->getApproved() == null){
                                            echo'
                                            <td class="min-width">
                                                <span class="status-btn warning-btn">pending</span>
                                            </td>
                                            ';
                                        }
                                        echo'
                                            <td class="min-width">
                                                <div class="action justify-content-end">
                                                    
                                                    <a class="edit visually-hidden" href="read-pdf.php?path='.$report->getReport().'">
                                                        <i class="lni lni-eye"></i>
                                                    </a>
                                                    <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="lni lni-more-alt"></i>
                                                    </button>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                                            <li class="dropdown-item">
                                                                <a href="../../../uploads/'.$report->getReport().'" download="'.$report->getReport().'" class="text-gray">download</a>
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
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="row g-3 needs-validation" action="submit-report.php" method="post" enctype="multipart/form-data" novalidate>
                    <div class="modal-body">
                            <div class="col">
                                <label for="validationCustom01" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="validationCustom01"  required>
                                <div class="valid-feedback">
                                Looks good!
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Choose file</label>
                                <input type="file" class="form-control" name="report" id="" placeholder="" aria-describedby="fileHelpId">
                                <div id="fileHelpId" class="form-text">Upload as PDf only</div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Submit Form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <script>
        const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
    </script>
<!-- ========== footer start =========== -->
<?php include(ROOT."includes/footer.inc.php");?>
<!-- ========== footer end =========== -->
