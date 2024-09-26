<!DOCTYPE html>
<html lang="en" class="h-100">


<!-- Mirrored from techzaa.getappui.com/larkon/admin/auth-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Sep 2024 15:06:50 GMT -->

<head>
     <!-- Title Meta -->
     <meta charset="utf-8" />
     <title>Sign In | Larkon - Responsive Admin Dashboard Template</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="A fully responsive premium admin dashboard template" />
     <meta name="author" content="Techzaa" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />

     <!-- App favicon -->
     <link rel="shortcut icon" href="assets_admin/images/favicon.ico">

     <!-- Vendor css (Require in all Page) -->
     <link href="assets_admin/css/vendor.min.css" rel="stylesheet" type="text/css" />

     <!-- Icons css (Require in all Page) -->
     <link href="assets_admin/css/icons.min.css" rel="stylesheet" type="text/css" />

     <!-- App css (Require in all Page) -->
     <link href="assets_admin/css/app.min.css" rel="stylesheet" type="text/css" />

     <!-- Theme Config js (Require in all Page) -->
     <script src="assets_admin/js/config.js"></script>
</head>

<body class="h-100">
<?php
    if (isset($_SESSION['message'])) {
        echo "<p>{$_SESSION['message']}</p>";

        // Xóa thông báo sau khi hiển thị để tránh lặp lại
        unset($_SESSION['message']);
    }
    ?>
     <div class="d-flex flex-column h-100 p-3">
          <div class="d-flex flex-column flex-grow-1">
               <div class="row h-100">
                    <div class="col-xxl-7">
                         <div class="row justify-content-center h-100">
                              <div class="col-lg-6 py-lg-5">
                                   <div class="d-flex flex-column h-100 justify-content-center">
                                        <div class="auth-logo mb-4">
                                             <a href="index.html" class="logo-dark">
                                                  <img src="assets_admin/images/logo-dark.png" height="24" alt="logo dark">
                                             </a>

                                             <a href="index.html" class="logo-light">
                                                  <img src="assets_admin/images/logo-light.png" height="24" alt="logo light">
                                             </a>
                                        </div>

                                        <h2 class="fw-bold fs-24">Sign In</h2>

                                        <p class="text-muted mt-1 mb-4">Enter your email address and password to access admin panel.</p>

                                        <div class="mb-5">
                                             <form action="index.php?act=admin" class="authentication-form" method="POST">
                                                  <div class="mb-3">
                                                       <label class="form-label" for="example-email">Email</label>
                                                       <input type="email" id="example-email"  name="email" class="form-control bg-" placeholder="Enter your email">
                                                  </div>
                                                  <div class="mb-3">
                                                       <a href="auth-password.html" class="float-end text-muted text-unline-dashed ms-1">Reset password</a>
                                                       <label class="form-label" for="example-password">Password</label>
                                                       <input type="password" id="example-password" class="form-control" name="password" placeholder="Enter your password">
                                                  </div>
                                                  <div class="mb-3">
                                                       <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                                       </div>
                                                  </div>

                                                  <div class="mb-1 text-center d-grid">
                                                       <button class="btn btn-soft-primary" name="login_admin" type="submit">Sign In</button>
                                                  </div>
                                             </form>

                                             <p class="mt-3 fw-semibold no-span">OR sign with</p>

                                             <div class="d-grid gap-2">
                                                  <a href="javascript:void(0);" class="btn btn-soft-dark"><i class="bx bxl-google fs-20 me-1"></i> Sign in with Google</a>
                                                  <a href="javascript:void(0);" class="btn btn-soft-primary"><i class="bx bxl-facebook fs-20 me-1"></i> Sign in with Facebook</a>
                                             </div>
                                        </div>

                                        <p class="text-danger text-center">Don't have an account? <a href="index.php?act=register_admin" class="text-dark fw-bold ms-1">Sign Up</a></p>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="col-xxl-5 d-none d-xxl-flex">
                         <div class="card h-100 mb-0 overflow-hidden">
                              <div class="d-flex flex-column h-100">
                                   <img src="assets_admin/images/small/img-10.jpg" alt="" class="w-100 h-100">
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- Vendor Javascript (Require in all Page) -->
     <script src="assets_admin/js/vendor.js"></script>

     <!-- App Javascript (Require in all Page) -->
     <script src="assets_admin/js/app.js"></script>

</body>


<!-- Mirrored from techzaa.getappui.com/larkon/admin/auth-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Sep 2024 15:06:50 GMT -->

</html>