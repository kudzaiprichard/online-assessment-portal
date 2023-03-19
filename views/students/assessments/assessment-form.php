<?php 
session_start();
if(!isset($_SESSION["email_address"])) {
    header("Location: ../../auth/signup/signup.php");
    exit();
}
require_once("../../../controllers/supervisorController.php");
require_once("../../../controllers/studentController.php");
define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/views/");
require_once("../../../controllers/assessorController.php");


include(ROOT."includes/header.inc.php");
// include(ROOT."includes/side-bar.inc.php");
    $studentController = new StudentController();
    $supervisorController = new SupervisorController();
    $assessorController = new AssessorController();
    $isEmpty = false;

    $student = $studentController->getLoggedInStudentByEmail($_SESSION["email_address"]);
    $assessmentForm = $supervisorController->getAssessmentFormByStudentId($student->getId());
    $supervisor = $assessorController->getSupervisorByStudentId($student->getSupervisor()); 

    
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
                    <a href="assessment-form.php" class="active">Assessment Form</a>
                </li>
                <li>
                    <a href="../reports/reports.php">Reports </a>
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
                <h2>Student</h2>
            </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
            <div class="breadcrumb-wrapper mb-30">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="#0">Assessment Form</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                    view
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
        <!-- End Col -->
        <div class="col card-style ">
            <?php 
                if(empty($assessmentForm)){
                echo '<h6 class="text-center text-muted m-3">Assessment Form Not Yet Created</h6>';
                }
            ?>
            <!--Start form-->
            <div class="container">
                <form class="row g-3 needs-validation" novalidate action="download-form.php" method="POST">
                <div class="mb-3 visually-hidden">
                    <label for="" class="form-label">id</label>
                    <?php echo'<input type="number" class="form-control" name="id" value="'.$assessmentForm->getId().'">';?>
                </div>
                <div class="row">
                    <!--start tile-->
                    <div class="col mt-30 mb-4">
                    <div class="">
                        <div class="row">
                        <div class="col-8">
                            <h6 class="text-medium mb-30">Assessment Form</h6>
                        </div>                   
                        </div>
                    </div>
                    </div>
                    <!--End tile-->
                    <!--Start Table-->
                    <div class="col-12">
                    <p class="text-sm mb-20">
                    Assessment Form for <b><?php echo $student->getFirstName() , ' ';  echo $student->getLastName(); ?></b>
                    <i><?php echo $student->getRegNumber();?></i>, <?php echo $student->getProgram();?>
                    </p>
                    <p class="text-sm mb-20">
                    Supervisor: <b><?php echo $supervisor->getFirstName() , ' ';  echo $supervisor->getLastName(); ?>,</b>
                    <i><?php echo $supervisor->getPosition();?></i>, <?php echo $supervisor->getCompanyName();?>
                    </p>
                    <table class="table striped-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><h6>Area Of Assessment</h6></th>
                            <th class="col-1"><h6>Rankings</h6></th>
                        </tr>
                        </thead>
                        <tbody>
                        <!--start tr-->
                        <tr>
                            <td>1.</td>
                            <td><p>Competence/Skills Level</p></td>
                            <td>
                            <select class="form-select form-select-sm" name="qn1" id="" disabled>
                                <?php echo'<option value="'.$assessmentForm->getQn1().'" selected>'.$assessmentForm->getQn1().'</option>';?>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            </td>
                        </tr>
                        <!--end tr-->

                        <!--start tr-->
                        <tr>
                            <td>2.</td>
                            <td><p>Ability to work with others/Cooperation</p></td>
                            <td>
                            <select class="form-select form-select-sm" name="qn2" id="" disabled>
                                <?php echo'<option value="'.$assessmentForm->getQn2().'" selected>'.$assessmentForm->getQn2().'</option>';?>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            </td>
                        </tr>
                        <!--end tr-->

                        <!--start tr-->
                        <tr>
                            <td>3.</td>
                            <td><p>Ability to take instructions/Knowledge application</p></td>
                            <td>
                            <select class="form-select form-select-sm" name="qn3" id="" disabled>
                                <?php echo'<option value="'.$assessmentForm->getQn3().'" selected>'.$assessmentForm->getQn3().'</option>';?>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            </td>
                        </tr>
                        <!--end tr-->

                        <!--start tr-->
                        <tr>
                            <td>4.</td>
                            <td><p>Organizational Skills</p></td>
                            <td>
                            <select class="form-select form-select-sm" name="qn4" id="" disabled>
                                <?php echo'<option value="'.$assessmentForm->getQn4().'" selected>'.$assessmentForm->getQn4().'</option>';?>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            </td>
                        </tr>
                        <!--end tr-->

                        <!--start tr-->
                        <tr>
                            <td>5.</td>
                            <td><p>Punctuality/Time management</p></td>
                            <td>
                            <select class="form-select form-select-sm" name="qn5" id="" disabled>
                                <?php echo'<option value="'.$assessmentForm->getQn5().'" selected>'.$assessmentForm->getQn5().'</option>';?>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            </td>
                        </tr>
                        <!--end tr-->

                        <!--start tr-->
                        <tr>
                            <td>6.</td>
                            <td><p>Commitment towards organization goal</p></td>
                            <td>
                            <select class="form-select form-select-sm" name="qn6" id="" disabled>
                                <?php echo'<option value="'.$assessmentForm->getQn6().'" selected>'.$assessmentForm->getQn6().'</option>';?>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            </td>
                        </tr>
                        <!--end tr-->

                        <!--start tr-->
                        <tr>
                            <td>7.</td>
                            <td><p>Problem identification, analysis and resolution</p></td>
                            <td>
                            <select class="form-select form-select-sm" name="qn7" id="" disabled>
                                <?php echo'<option value="'.$assessmentForm->getQn7().'" selected>'.$assessmentForm->getQn7().'</option>';?>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            </td>
                        </tr>
                        <!--end tr-->

                        <!--start tr-->
                        <tr>
                            <td>8.</td>
                            <td><p>Management and Leadership skills</p></td>
                            <td>
                            <select class="form-select form-select-sm" name="qn8" id="" disabled>
                                <?php echo'<option value="'.$assessmentForm->getQn8().'" selected>'.$assessmentForm->getQn8().'</option>';?>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            </td>
                        </tr>
                        <!--end tr-->

                        <!--start tr-->
                        <tr>
                            <td>9.</td>
                            <td><p>Accuracy and Thoroughness</p></td>
                            <td>
                            <select class="form-select form-select-sm" name="qn9" id="" disabled>
                                <?php echo'<option value="'.$assessmentForm->getQn9().'" selected>'.$assessmentForm->getQn9().'</option>';?>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            </td>
                        </tr>
                        <!--end tr-->
                        </tbody>
                    </table>
                    </div>
                    <!--End Table-->
                    <hr>
                    <div class="mb-3">
                    <label for="" class="form-label"><span class="text-black">10.</span> General/Overall comment</label>
                    <?php echo '<textarea class="form-control text-dark form-text" name="comment" id="" rows="3" disabled>'.$assessmentForm->getComment().'</textarea>';?>
                    </div>
                </div>
                    <div class="">
                        <?php echo '<a href="download-form.php?email='.$student->getEmailAddress().'" class="btn btn-outline-dark float-end mr-5" >Download Form</a>'?>
                    </div>
                </form>
            </div>
            <!--End form-->
            </div>
        </div>
        <!-- End Col -->
        </div>
        <!-- End Row -->
    </section>
    <!-- ========== section end ========== -->
<!-- ========== footer start =========== -->
<?php include(ROOT."includes/footer.inc.php");?>
<!-- ========== footer end =========== -->
