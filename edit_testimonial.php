<?php
require_once 'core/init.php';

$err = array();
$msg = array();

$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
    die();
}

if (isset($_GET['id'])) {
    $lid = $_GET['id'];
}


try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Your SQL query
    $sql = "SELECT * FROM testimonials WHERE id = '$lid'";

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch all rows as an associative array
    $listings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


if (isset($_POST["doUpdate"]) == 'Update') {


    if (empty($_POST['uname'])) {
        $err[] = "Testimonial User cannot be banl";
    }

    if (empty($_POST['testimonial_text'])) {
        $err[] = "Testimonial cannot be blank";
    }




    if (empty($err)) {
        $uname = $_POST['uname'];
        $testimonial_text = $_POST['testimonial_text'];
        $id = $_POST['id'];

        try {
            // Create a PDO connection
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            // Set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE testimonials SET testimonial = :testimonial_text, customer = :uname WHERE id = :id";


            // Prepare and execute the query
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':uname', $uname);
            $stmt->bindParam(':testimonial_text', $testimonial_text);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
                $msg[] = "Testimonial added successfully!";
                header("Location: edit_testimonial.php?id=$lastInsertedId");
                exit(); // Important to exit after redirection
           
        } catch (PDOException $e) {
            echo '' . $e->getMessage();
        }
    } else {
        // Output errors
        foreach ($err as $error) {
            echo $error . "<br>";
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


    <title>REALENGINE - A CRM built for REALtors</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="assets/vendors/core/core.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/flatpickr/flatpickr.min.css">
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

        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="myaccount.php" class="sidebar-brand">
                    REAL<span> ENGINE</span>
                </a>
                <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="sidebar-body">
                <?php include('_include/inc_sidemenu.php'); ?>
            </div>
        </nav>

        <!-- partial -->

        <div class="page-wrapper">

            <!-- Top Nav Bar Start -->
            <nav class="navbar">
                <a href="#" class="sidebar-toggler">
                    <i data-feather="menu"></i>
                </a>
                <div class="navbar-content">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30?text=" alt="profile">
                            </a>
                            <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                                <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                                    <div class="mb-3">
                                        <img class="wd-80 ht-80 rounded-circle" src="https://via.placeholder.com/80x80?text=" alt="">
                                    </div>
                                    <div class="text-center">
                                        <p class="tx-16 fw-bolder"><?php echo $user->data()->first_name; ?></p>
                                        <p class="tx-12 text-muted"><?php echo $user->data()->email; ?></p>
                                    </div>
                                </div>
                                <ul class="list-unstyled p-1">
                                    <li class="dropdown-item py-2">
                                        <a href="logout.php" class="text-body ms-0">
                                            <i class="me-2 icon-md" data-feather="log-out"></i>
                                            <span>Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Top Nav Bar End -->




            <div class="page-content">
                <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                    <div>
                        <h4 class="mb-3 mb-md-0">EDIT TESTIMONIAL</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?php

                        foreach ($err as $error) {

                            echo '<div class="alert alert-success text-center" role="alert">' . $error . '</div>';
                        }
                        ?>
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">EDIT TESTIMONIAL</h6>
                                <?php foreach ($listings as $listing) : ?>
                                    <form class="forms-listing" method="POST" action="" enctype="multipart/form-data">
                                        <input type="hidden" name="id" id="id" value="<?php echo $listing['id']; ?>" />
                                        <div class="mb-3">
                                            <label for="uname" class="form-label">Customer / User Name</label>
                                            <input type="text" class="form-control text-danger" name="uname" id="uname" placeholder="John B"  value="<?php echo $listing['customer']; ?>" required>
                                        </div>
                                        <div class=" mb-3">
                                            <label for="testimonial_text" class="form-label">Testimonial</label>
                                            <textarea class="form-control text-danger" id="testimonial_text" name="testimonial_text" row="5" required><?php echo $listing['testimonial']; ?></textarea>
                                        </div>
                                        <input type="submit" name="doUpdate" id="doUpdate" value="Update" class="btn btn-success" />

                                    </form>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Start -->
            <?php include('_include/inc_footer.php'); ?>
            <!-- Footer End -->

        </div>
    </div>

    <!-- core:js -->
    <script src="assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="assets/vendors/flatpickr/flatpickr.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="assets/vendors/feather-icons/feather.min.js"></script>
    <script src="assets/js/template.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="assets/js/dashboard-light.js"></script>
    <!-- End custom js for this page -->

</body>

</html>