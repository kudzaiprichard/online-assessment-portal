<?php 
    session_start();
    if(!isset($_SESSION["email_address"])) {
      header("Location: ../../auth/signup/signup.php");
      exit();
    }
    require_once("../../../controllers/supervisorController.php");
    require_once("../../../controllers/studentController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/views/");
    include(ROOT."includes/header.inc.php");
    // include(ROOT."includes/side-bar.inc.php");
      $studentController = new StudentController();
      $supervisorController = new SupervisorController();

    if (isset($_GET['id'])) {
      $studentId = $_GET['id'];
      $assessmentForm = $supervisorController->getAssessmentFormByStudentId($studentId);
      $student = $studentController->getLoggedInUserById($studentId);
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
                      <a href="assessment-form.php" class="active">Assessment Forms</a>
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
                  <h2>Supervisor</h2>
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
                        Update
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
                <!--Start form-->
                <div class="container">
                  <form class="row g-3 needs-validation" novalidate action="create-update-form.php">
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
                        Update Assessment Form for <b><?php echo $student->getFirstName() , ' ';  echo $student->getLastName(); ?></b>
                        <i><?php echo $student->getRegNumber();?></i>, <?php echo $student->getProgram();?>
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
                                <select class="form-select form-select-sm" name="qn1" id="">
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
                                <select class="form-select form-select-sm" name="qn2" id="">
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
                                <select class="form-select form-select-sm" name="qn3" id="">
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
                                <select class="form-select form-select-sm" name="qn4" id="">
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
                                <select class="form-select form-select-sm" name="qn5" id="">
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
                                <select class="form-select form-select-sm" name="qn6" id="">
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
                                <select class="form-select form-select-sm" name="qn7" id="">
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
                                <select class="form-select form-select-sm" name="qn8" id="">
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
                                <select class="form-select form-select-sm" name="qn9" id="">
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
                        <?php echo '<textarea class="form-control text-dark form-text" name="comment" id="" rows="3">'.$assessmentForm->getComment().'</textarea>';?>
                      </div>
                    </div>

                    <div class="">
                      <button type="submit" name="update" class="btn btn-primary float-end ml-5">Update Form</button>
                      <a class="btn btn-outline-dark float-end mr-5">Download Form</a>
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
