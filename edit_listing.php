<?php
require_once 'core/init.php';
require_once 'classes/Listings.php';

$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
    die();
}

$lid = $_GET['id'];

// Replace these variables with your database credentials
$servername = "localhost";
$username = "cms_admin";
$password = "cQ&cH_k)Xybr";
$dbname = "cms_livewd";

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Your SQL query
    $sql = "SELECT * FROM listings WHERE id = '$lid'";

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch all rows as an associative array
    $listings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


if(isset($_POST["doUpdate"]) == 'Update') {
    echo "updated";
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
            <?php if (!empty($listings)) : ?>
                <div class="page-content">
                    <?php foreach ($listings as $listing) : ?>
                        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                            <div>
                                <h4 class="mb-3 mb-md-0">MLSID: <?php echo $listing['mlsid']; ?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h6 class="card-title">MLSID: <?php echo $listing['mlsid']; ?></h6>

                                        <form class="forms-listing" method="POST" action="">
                                            <div class="mb-3">
                                                <label for="price" class="form-label">Price</label>
                                                <input type="text" class="form-control text-danger" name="price" id="price" value="<?php echo $listing['price']; ?>" placeholder="619,000" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="address1" class="form-label">Address 1</label>
                                                <input type="text" class="form-control text-danger" id="address1" name="address1" value="<?php echo $listing['address1']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="address2" class="form-label">Address 2</label>
                                                <input type="text" class="form-control text-danger" id="address2" name="address2" value="<?php echo $listing['address2']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control text-danger" id="description" name="description" row="3" required><?php echo $listing['property_description']; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="sqft" class="form-label">Area / Sq.Ft</label>
                                                <input type="text" class="form-control text-danger" id="sqft" name="sqft" value="<?php echo $listing['sqft']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="property_url" class="form-label">Property URL</label>
                                                <input type="text" class="form-control text-danger" id="property_url" name="property_url" value="<?php echo $listing['property_url']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" id="status" class="form-control text-danger">
                                                    <option value="ACTIVE" <?php if($listing['status'] =='ACTIVE'){ echo "selected"; } ?> >Active</option>
                                                    <option value="SOLD" <?php if($listing['status'] =='SOLD'){ echo "selected"; } ?> >Sold</option>
                                                    <option value="DELETED"  <?php if($listing['status'] =='DELETED'){ echo "selected"; } ?> >Deleted</option>
                                                    <option value="INACTIVE"  <?php if($listing['status'] =='INACTIVE'){ echo "selected"; } ?> >Inactive</option>
                                                </select>
                                            </div>
                                            <input type="submit" name="doUpdate" id="doUpdate" value="Update" class="btn btn-success" />
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>




                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p>No listings found.</p>
            <?php endif; ?>
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