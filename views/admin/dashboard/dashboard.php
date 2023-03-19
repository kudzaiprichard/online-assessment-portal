<?php 
    session_start();
    if(!isset($_SESSION["email_address"])) {
      header("Location: ../../auth/signup.php");
      exit();
    }
    require_once("../../../controllers/adminController.php");
    // require_once("../../controllers/studentController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/views/");
    include(ROOT."includes/header.inc.php");
    // include(ROOT."includes/side-bar.inc.php");

    $adminController = new AdminController();
    $users = $adminController->fetchAllUsers();
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
                      <a href="#" class="active">Dashboard </a>
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
                  <span class="text">Manage Student</span>
              </a>
              <ul id="ddmenu" class="collapse show dropdown-nav">
                  <li>
                      <a href="../supervisor/supervisor.php">Supervisor</a>
                  </li>
                  <li>
                      <a href="../assessor/assessor.php">Assessors</a>
                  </li>
                  <li>
                      <a href="../students/students.php">Students </a>
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
                  <h2>Admin Dashboard</h2>
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="#0">Dashboard</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                        admin
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
            <div class="col">
              <div class="card-style mb-30">
                
                <div class="table-responsive">
                  <table class="table top-selling-table">
                    <thead>
                      <tr>
                        <th></th>
                        <th>
                          <h6 class="text-sm text-medium">Email Address</h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">Account Type</h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">Registration Status</h6>
                        </th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($users as $user){
                          if($user->getAccountType() != "admin"){
                            if($user->getPassword() == ""){$isRegistered = "Pending";}else{$isRegistered = "Completed";}
                              echo '
                                    <tr>
                                    <td>
                                      <div class="check-input-primary">
                                        <input
                                          class="form-check-input"
                                          type="checkbox"
                                          id="checkbox-1"
                                        />
                                      </div>
                                    </td>
                                    <td>
                                      <div class="product">
                                        <div class="image">
                                          <img
                                            src="assets/images/products/product-mini-1.jpg"
                                            alt=""
                                          />
                                        </div>
                                        <p class="text-sm">'.$user->getEmailAddress().'</p>
                                      </div>
                                    </td>
                                    <td>
                                      <p class="text-sm">'.$user->getAccountType().'</p>
                                    </td>
                                    ';

                                    if($isRegistered == "Pending"){
                                      echo '
                                      <td>
                                        <span class="status-btn info-btn">'.$isRegistered.'</span>
                                      </td>';
                                    }

                                    if($isRegistered == "Completed"){
                                      echo '
                                      <td>
                                        <span class="status-btn success-btn">'.$isRegistered.'</span>
                                      </td>';
                                    }

                                    echo '<td>
                                      <a href="delete-user.php?id='.$user->getEmailAddress().'" class="text-danger">
                                        <i class="lni lni-trash-can"></i>
                                      </a>
                                    </td>
                                  </tr>
                              ';
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
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
