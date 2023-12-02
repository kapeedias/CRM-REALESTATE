<?php
require_once 'core/init.php';


if (Input::exists()) {

    //CSRF Protection
    if (Token::check(Input::get('token'))) {

        //echo Input::get('username');
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' =>  array(
                'name'     => 'Username',
                'required' => true,
                'min'      => 2,
                'max'      => 20,
                'unique'   => 'crm_users'
            ),
            'password_hash' => array(
                'name'     => 'Password',
                'required' => true,
                'min'      => 8
            ),
            'passwordagain' => array(
                'name'     => 'Re-Enter Password',
                'required' => true,
                'matches'  => 'password_hash'
            ),
            'first_name' => array(
                'first_name'     => 'First Name',
                'required' => true,
                'min'      => 2,
                'max'      => 50
            ),
            'last_name' => array(
                'last_name'     => 'Last Name',
                'required' => true,
                'min'      => 2,
                'max'      => 50
            )
        ));


        if ($validation->passed()) {

            $user = new User();
            $salt = Hash::salt(32);

            try {

                $user->create([
                    'username' => Input::get('username'),
                    'password_hash' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'first_name' => Input::get('first_name'),
                    'last_name' => Input::get('last_name'),
                    'joined' => date('Y-m-d H:i:s'),
                    'group' => '1',
                    'email' => Input::get('email'),
                    'tel' => Input::get('tel')
                ]);

                Session::flash('success', 'You are registered successfully!');
                Redirect::to('index.php');
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
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
    <meta name="description" content="A Powerful CRM for Realtors">
    <meta name="author" content="Live Web Design">


    <title>RealEngine - A CRM built for Realtors</title>

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
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card">
                            <div class="row">

                                <div class="col-12 p-3">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="#" class="noble-ui-logo d-block mb-2 text-center">Real<span> Engine</span></a>
                                        <h5 class="text-muted fw-normal mb-4 text-center">Create a free account.</h5>
                                        <form class="forms-sample" action="" method="POST">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">Frist Name</label>
                                                <input type="text" name="first_name" id="first_name" value="<?php echo Input::get('first_name'); ?>" class="form-control" autocomplete="off" required />
                                            </div>
                                            <div class="mb-3">
                                                <label for="last_name" class="form-label">Last Name</label>
                                                <input type="text" name="last_name" id="last_name" value="<?php echo Input::get('last_name'); ?>" class="form-control" autocomplete="off" required />
                                            </div>
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username/Email</label>
                                                <input type="text" name="username" id="username" value="<?php echo Input::get('username'); ?>" class="form-control" autocomplete="off" required />
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" name="password_hash" id="password" value="" class="form-control" autocomplete="off" required />
                                            </div>
                                            <div class="mb-3">
                                                <label for="passwordagain" class="form-label">Re-Enter Password</label>
                                                <input type="password" name="passwordagain" id="passwordagain" value="" class="form-control" autocomplete="off" required />
                                            </div>
                                            <div>
                                                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                                                <input type="submit" name="doRegister" id="doRegister" value="Register" class="btn btn-success" />
                                            </div>
                                            <a href="login.php" class="d-block mt-3 text-muted">Already a user? Sign in</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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