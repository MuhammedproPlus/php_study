<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>DreamsEstate</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Toastr CSS for toast messages -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>

    <!-- Loader -->
    <div class="page-loader">
        <div class="page-loader-inner">
            <img src="assets/img/icons/loader.svg" alt="Loader">
            <label><i class="fa-solid fa-circle"></i></label>
            <label><i class="fa-solid fa-circle"></i></label>
            <label><i class="fa-solid fa-circle"></i></label>
        </div>
    </div>
    <!-- /Loader -->

    <!-- Main Wrapper -->
    <div class="main-wrapper login-body">
        <div class="container">
            <!-- Header -->
            <header class="log-header">
                <a href="index.html"><img class="img-fluid logo-dark" src="assets/img/logo.svg" alt="Logo"></a>
            </header>
            <!-- /Header -->

            <div class="login-wrapper">
                <div class="loginbox">
                    <div class="login-auth">
                        <div class="login-auth-wrap">
                            <h1>Signup! <span class="d-block"> New Account.</span></h1>
                            <form action="./action_register.php" method="POST">
                                <div class="form-group">
                                    <label class="form-label">Name <span>*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Address <span>*</span></label>
                                    <input type="text" class="form-control" name="address" placeholder="Enter Address" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone Number <span>*</span></label>
                                    <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email <span>*</span></label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Password <span>*</span></label>
                                    <div class="pass-group">
                                        <input type="password" class="form-control pass-input" name="password" placeholder="Enter Password" required>
                                        <span class="fas fa-eye toggle-password"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirm Password <span>*</span></label>
                                    <div class="pass-group">
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="custom_check mt-0 mb-0"><span>Remember me</span>
                                        <input type="checkbox" name="remember">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-outline-light w-100 btn-size">Sign Up</button>
                                <div class="text-center dont-have">Already have login? <a href="login.html">Sign In</a></div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- Toastr JS for toast messages -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>

    <?php if ($registrationSuccess): ?>
    <script>
        // Show success toast message
        toastr.success('Registration successful. Redirecting to login page...');

        // Redirect to login page after 2 seconds
        setTimeout(function() {
            window.location.href = 'login.php';
        }, 2000);
    </script>
    <?php endif; ?>

</body>

</html>
