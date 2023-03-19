<?php 
    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/assessment_portal/views/");
    include(ROOT."includes/header.inc.php");
?>

<!-- ======== main-wrapper start =========== -->
<main class="mx-5 p-5">

    <?php
        if (isset($_GET['msg'])){
          $msg = $_GET['msg'];
          echo '
          <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-div">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong class="">'.$msg.'</strong>
          </div>
        ';
          }
    ?>

      <!-- ========== signin-section start ========== -->
      <section class="signin-section mb-5" >
        <div class="container-fluid">
          <div class="row g-0 auth-row">
            <div class="col-lg-6">
              <div class="auth-cover-wrapper bg-primary-100">
                <div class="auth-cover">
                  <div class="title text-center">
                    <h1 class="text-primary mb-10">Welcome Back</h1>
                    <p class="text-medium">
                      Sign in to your Existing account to continue
                    </p>
                  </div>
                  <div class="cover-image">
                    <img src="assets/images/auth/signin-image.svg" alt="" />
                  </div>
                  <div class="shape-image">
                    <img src="assets/images/auth/shape.svg" alt="" />
                  </div>
                </div>
              </div>
            </div>
            <!-- end col -->
            <div class="col-lg-6">
              <div class="signin-wrapper">
                <div class="form-wrapper">
                  <h6 class="mb-15">Sign In Form</h6>
                  <p class="text-sm mb-25">
                    If you are registered, login below.
                  </p>
                  <form action="log-user.php">
                    <div class="row">
                      <div class="col-12">
                        <div class="input-style-1">
                          <label>Email</label>
                          <input type="email" placeholder="Email" name="email_address"/>
                        </div>
                      </div>
                      <!-- end col -->
                      <div class="col-12">
                        <div class="input-style-1">
                          <label>Password</label>
                          <input type="password" placeholder="Password" name="password"/>
                        </div>
                      </div>
                      <!-- end col -->
                      <div class="col-xxl-6 col-lg-12 col-md-6">
                        <div class="form-check checkbox-style mb-30">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            value=""
                            id="checkbox-remember"
                          />
                          <label
                            class="form-check-label"
                            for="checkbox-remember"
                          >
                            Remember me next time</label
                          >
                        </div>
                      </div>
                      <!-- end col -->
                      <div class="col-xxl-6 col-lg-12 col-md-6">
                        <div
                          class="
                            text-start text-md-end text-lg-start text-xxl-end
                            mb-30
                          "
                        >
                          <a href="#0" class="hover-underline"
                            >Forgot Password?</a
                          >
                        </div>
                      </div>
                      <!-- end col -->
                      <div class="col-12">
                        <div
                          class="
                            button-group
                            d-flex
                            justify-content-center
                            flex-wrap
                          "
                        >
                          <button
                            type="submit"
                            class="
                              main-btn
                              primary-btn
                              btn-hover
                              w-100
                              text-center
                            "
                          >
                            Sign In
                          </button>
                        </div>
                      </div>
                    </div>
                    <!-- end row -->
                  </form>
                  <div class="singin-option pt-40">
                    <p class="text-sm text-medium text-dark text-center">
                      Don’t have any account yet?
                      <a href="../signup/signup.php">Create an account</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
      </section>
      <!-- ========== signin-section end ========== -->
<!-- ========== footer start =========== -->
<?php include(ROOT."includes/footer.inc.php");?>
<!-- ========== footer end =========== -->