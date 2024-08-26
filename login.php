<?php

require_once 'core/init.php';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST,
            array(
                'username' => array('required' => true),
                'password' => array('required' => true)
            )
        );
        
        if ($validation->passed()) {
            $user = new User();
            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('username'), Input::get('password'));

            if ($login) {
                Redirect::to('myaccount.php');
                echo "Success";
            } else {
                Session::flash('error', 'Login Failed. Please try again later');
                //echo "Login Failed";
            }
        } else {
            foreach ($validation->errors() as $error) {
                Session::flash('error', $error.'<br>');
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="A Powerful CRM for REALtors">
    <meta name="author" content="Live Web Design">

    <title>REAL360 - A CRM built for REALtors</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="assets/vendors/core/core.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="assets/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-4 col-xl-4 mx-auto">
                        <?php
                        if (Session::exists('home')) {
                            echo '<div class="alert alert-success text-center" role="alert">' . Session::flash('home') . '</div>';
                        }elseif (Session::exists('error')) {
                            echo '<div class="alert alert-danger text-center" role="alert">' . Session::flash('error') . '</div>';
                        }
                        ?>
                        <div class="card">
                            <div class="row">

                                <div class="col-12 p-4">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="#"
                                            class="noble-ui-logo d-block mb-2 text-center">REAL<span>360</span></a>
                                        <form action="" method="POST" class="form">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Email address</label>
                                                <input type="text" name="username" id="username"
                                                    value="<?php echo Input::get('username'); ?>" class="form-control"
                                                    autocomplete="off" placeholder="Email" required="yes" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" name="password" id="password"
                                                    class="form-control" autocomplete="off" required="yes" />
                                            </div>
                                            <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" id="remember"
                                                    name="remember">
                                                <label class="form-check-label" for="remember">
                                                    Remember me
                                                </label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input type="hidden" name="token"
                                                    value="<?php echo Token::generate(); ?>" />
                                                <input type="submit" name="doLogin" id="doLogin" value="Login"
                                                    class="btn btn-success" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="footer-text"> &copy; Copyright Live Web Design. All Rights Reserved. Usage under
                            licence.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- core:js -->
    <script src="assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="assets/vendors/feather-icons/feather.min.js"></script>
    <script src="assets/js/template.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <!-- End custom js for this page -->

</body>

</html>