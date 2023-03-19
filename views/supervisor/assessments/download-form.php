<?php
define('VIEWS',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/views/");
define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/controllers/");
require_once(ROOT."Connection.php");
require_once("../../../controllers/supervisorController.php");
require_once("../../../controllers/studentController.php");
require_once("../../../controllers/assessorController.php");

$a=0;
if($a==1){
    header("location: assessment-form.php");
}

$db = new Connection("localhost", "root", "", "portal");
$con = $db->openConnection();
$studentController = new StudentController();
$assessorController = new AssessorController();
$supervisorController = new SupervisorController();

$student = $studentController->getLoggedInStudentByEmail($_GET["email"]);
$assessmentForm = $supervisorController->getAssessmentFormByStudentId($student->getId());
$supervisor = $assessorController->getSupervisorByStudentId($student->getSupervisor());

include(VIEWS."includes/header.inc.php");


?>

<!-- ========== section start ========== -->
<section class="section card-style ">
    <div class="container-fluid mp-5">
        <!--Pdf header-->
        <section>
            <div class="row">
                <center>
                    <h6>TRUST ACADEMY</h6>
                    <p>in collaboration with</p>
                    <h6>MIDLANDS STATE UNIVERSITY</h6>
                </center>
            </div>
            <hr>
            <div class="row px-5">
                <div class="col">
                    <img src="../../../assets/images/logo.jpg" alt="" class="img-thumbnail" width="100px;">
                </div>
                <div class="col">
                    <h6><small>HEAD ICT DEPARTMENT</small></h6>
                    <h6><small>P O Box CY 2201</small></h6>
                    <h6><small>Causeway</small></h6>
                </div>
                <div class="col">
                    <h6><small>TEL: +263 4 790988</small></h6>
                    <h6><small>FAX: +263 4 790996</small></h6>
                    <h6><small><u class="text-primary">ict@trustacademy.co.zw</u></small></h6>
                </div>
            </div>
            
            <div class="row mt-4">
                <center>
                    <h7><p>FACULTY OF SCIENCE AND TECHNOLOGY</p></h7>
                    <h7><p>STUDENT ASSESSMENT FORM ICT BMIS3.2</p></h7>
                </center>
            </div>
        </section>
            
        <section class="px-5 mt-5">
            <div class="row mt-5">
                <h3><small><u>Scoring key: (Score 1 to 5)</u></small></h3>
                <div class="mx-3">
                    <p>
                        <b>1.</b> <i>Poor</i>
                    </p>
                    <p>
                        <b>2.</b> <i>Fair</i>
                    </p>
                    <p>
                        <b>3.</b> <i>Satisfactory</i>
                    </p>
                    <p>
                        <b>4.</b> <i>Good</i>
                    </p>
                    <p>
                        <b>5.</b> <i>Exceptionally Good</i>
                    </p>
                </div>
            </div>
        </section>

        <section class="mt-1 p-5">
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
                        <span class="bg-dark-100 px-5 py-1">
                            <?php echo $assessmentForm->getQn1();?>
                        </span>
                    </td>
                </tr>
                <!--end tr-->

                <!--start tr-->
                <tr>
                    <td>2.</td>
                    <td><p>Ability to work with others/Cooperation</p></td>
                    <td>
                        <span class="bg-dark-100 px-5 py-1">
                            <?php echo $assessmentForm->getQn2();?>
                        </span>
                    </td>
                </tr>
                <!--end tr-->

                <!--start tr-->
                <tr>
                    <td>3.</td>
                    <td><p>Ability to take instructions/Knowledge application</p></td>
                    <td>
                        <span class="bg-dark-100 px-5 py-1">
                            <?php echo $assessmentForm->getQn3();?>
                        </span>
                    </td>
                </tr>
                <!--end tr-->

                <!--start tr-->
                <tr>
                    <td>4.</td>
                    <td><p>Organizational Skills</p></td>
                    <td>
                        <span class="bg-dark-100 px-5 py-1">
                            <?php echo $assessmentForm->getQn4();?>
                        </span>
                    </td>
                </tr>
                <!--end tr-->

                <!--start tr-->
                <tr>
                    <td>5.</td>
                    <td><p>Punctuality/Time management</p></td>
                    <td>
                        <span class="bg-dark-100 px-5 py-1">
                            <?php echo $assessmentForm->getQn5();?>
                        </span>
                    </td>
                </tr>
                <!--end tr-->

                <!--start tr-->
                <tr>
                    <td>6.</td>
                    <td><p>Commitment towards organization goal</p></td>
                    <td>
                        <span class="bg-dark-100 px-5 py-1">
                            <?php echo $assessmentForm->getQn6();?>
                        </span>
                    </td>
                </tr>
                <!--end tr-->

                <!--start tr-->
                <tr>
                    <td>7.</td>
                    <td><p>Problem identification, analysis and resolution</p></td>
                    <td>
                        <span class="bg-dark-100 px-5 py-1">
                            <?php echo $assessmentForm->getQn7();?>
                        </span>
                    </td>
                </tr>
                <!--end tr-->

                <!--start tr-->
                <tr>
                    <td>8.</td>
                    <td><p>Management and Leadership skills</p></td>
                    <td>
                        <span class="bg-dark-100 px-5 py-1">
                            <?php echo $assessmentForm->getQn8();?>
                        </span>
                    </td>
                </tr>
                <!--end tr-->

                <!--start tr-->
                <tr>
                    <td>9.</td>
                    <td><p>Accuracy and Thoroughness</p></td>
                    <td>
                        <span class="bg-dark-100 px-5 py-1">
                            <?php echo $assessmentForm->getQn9();?>
                        </span>
                    </td>
                </tr>
                <!--end tr-->
                </tbody>
            </table>
            <hr>
            <div class="mb-3">
                <label for="" class="form-label"><span class="text-black">10.</span> General/Overall comment</label>
                <?php echo '<textarea class="form-control text-dark form-text" name="comment" id="" rows="3" disabled>'.$assessmentForm->getComment().'</textarea>';?>
            </div>
        </section>
    </div>
</section>
<script>
    if(print()){
        <?php 
            $a = 1;
        ?>
    }
</script>
