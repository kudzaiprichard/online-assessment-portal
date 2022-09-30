<?php 
    session_start();
    if(!isset($_SESSION["email_address"])) {
      header("Location: ../auth/signup.php");
      exit();
    }
    require_once("../../controllers/adminController.php");
    // require_once("../../controllers/studentController.php");
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/views/");
    include(ROOT."includes/header.inc.php");
    include(ROOT."includes/side-bar.inc.php");

    $adminController = new AdminController();
    $users = $adminController->fetchAllUsers();
?>
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
                <div
                  class="
                    title
                    d-flex
                    flex-wrap
                    justify-content-between
                    align-items-center
                  "
                >
                  <div class="left">
                    <h6 class="text-medium mb-30">Users</h6>
                  </div>
                  <div class="right">
                    <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalId">Add A User</a>
                    <!-- end select -->
                  </div>
                </div>
                <!-- End Title -->
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
                                <td>
                                  <p class="text-sm">'.$isRegistered.'</p>
                                </td>
                                <td>
                                  <div class="action justify-content-end">
                                    <button
                                      class="more-btn ml-10 dropdown-toggle"
                                      id="moreAction1"
                                      data-bs-toggle="dropdown"
                                      aria-expanded="false"
                                    >
                                      <i class="lni lni-more-alt"></i>
                                    </button>
                                    <ul
                                      class="dropdown-menu dropdown-menu-end"
                                      aria-labelledby="moreAction1"
                                    >
                                      <li class="dropdown-item">
                                        <a href="delete-user.php?id='.$user->getEmailAddress().'" class="text-gray">Remove</a>
                                      </li>
                                      <li class="dropdown-item">
                                        <a href="edit-user.php?id='.$user->getEmailAddress().'" class="text-gray">Edit</a>
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

                  <!-- Modal Body -->
                  <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                  <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTitleId">Add A User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="row g-3 needs-validation" action="save-student.php" novalidate>
                            <div class="col-md-4">
                              <label for="validationCustom01" class="form-label">First name</label>
                              <input type="text" name="first_name" class="form-control" id="validationCustom01" value="Mark" required>
                              <div class="valid-feedback">
                                Looks good!
                              </div>
                            </div>
                            <div class="col-md-4">
                              <label for="validationCustom02" class="form-label">Last name</label>
                              <input type="text" name="last_name" class="form-control" id="validationCustom02" value="Otto" required>
                              <div class="valid-feedback">
                                Looks good!
                              </div>
                            </div>
                            <div class="col-md-4">
                              <label for="validationCustomUsername" class="form-label">Reg Number</label>
                              <div class="input-group">
                                <input type="text" name="reg_number" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                  Please choose a Reg Number.
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <label for="validationCustom03" class="form-label">Program</label>
                              <input type="text" name="program" class="form-control" id="validationCustom03" required>
                              <div class="invalid-feedback">
                                Please provide a valid Program.
                              </div>
                            </div>
                            <div class="col-6">
                              <label for="validationCustom03" class="form-label">Email Address</label>
                              <input type="email" name="email_address" class="form-control" id="validationCustom03" required>
                              <div class="invalid-feedback">
                                Please provide a valid Email Address.
                              </div>
                            </div>
                            <div class="col">
                              <label for="validationCustom05" class="form-label">Mobile Number</label>
                              <input type="text" name="phone_number" class="form-control" id="validationCustom05" required>
                              <div class="invalid-feedback">
                                Please provide a valid Mobile Number.
                              </div>
                            </div>
                            <div class="col">
                              <label for="validationCustom05" class="form-label">Physical Address</label>
                              <input type="text" name="physical_address" class="form-control" id="validationCustom05" required>
                              <div class="invalid-feedback">
                                Please provide a valid Physical Address.
                              </div>
                            </div>
                            <div class="col-md-3">
                              <label for="validationCustom04" class="form-label">Account Type</label>
                              <select class="form-select" id="validationCustom04" name="account_type" required >
                                <option selected value="supervisor">Supervisor</option>
                                <option value="student">Student</option>
                                <option value="assessor">Assessor</option>
                                <option value="admin">Admin</option>
                              </select>
                              <div class="invalid-feedback">
                                Please select a valid type.
                              </div>
                            </div>                         
                        </div>
                        <div class="modal-footer mt-3">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button class="btn btn-primary" type="submit" value="create_user" name="create_user">Save User</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  
                  
                  <!-- Optional: Place to the bottom of scripts -->
                  <script>
                    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
                  
                  </script>
                  <!-- End Table -->
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
