<?php
require_once 'core/init.php';
require_once 'classes/Listings.php';

$publicHtmlPath = dirname(__DIR__);
$mls_img_upload = $publicHtmlPath . "/assets/img/mls";


$err = array();
$msg = array();

$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
    die();
}

/*

if (isset($_POST["doAdd"]) == 'Add') {


    if (empty($_POST['mlsid'])) {
        $err[] = "MLS ID cannot be blank";
    }
    if (empty($_POST['price'])) {
        $err[] = "Price cannot be blank";
    }
    if (empty($_POST['address1'])) {
        $err[] = "Address1 cannot be blank";
    }
    if (empty($_POST['description'])) {
        $err[] = "Property Description cannot be blank";
    }
    if (empty($_POST['sqft'])) {
        $err[] = "Area / SQFT cannot be blank";
    }
    if (empty($_POST['property_url'])) {
        $err[] = "Property URL cannot be blank";
    }
    if (empty($_FILES['property_image']['name'])) {
        $err[] = 'Property Image cannot be empty.';
    }

    // If there are no input errors, perform the update
    if (empty($err)) {
        $mlsid = $_POST['mlsid'];
        $price = $_POST['price'];
        $address1 = $_POST['address1'];
        $property_description = $_POST['description'];
        $sqft = $_POST['sqft'];
        $property_url = $_POST['property_url'];
        $created_by = $user->data()->username;
        //$created_on = Date('Y-m-d H:i:s');
        $status = $_POST['status'];


        $mls_listing_folder = $mls_img_upload . "/" . $mlsid;

        // Check if the directory doesn't exist, then create it
        if (!is_dir($mls_listing_folder)) {
            // The third parameter (true) specifies recursive creation, creating all necessary directories
            mkdir($mls_listing_folder, 0777, true);

            // Check if the directory was created successfully
            if (is_dir($mls_listing_folder)) {
                $file_name = $_FILES['property_image']['name'];
                $file_tmp = $_FILES['property_image']['tmp_name'];
                $file_type = $_FILES['property_image']['type'];

                // Validate file type to allow images and videos only
                $allowed_types = array('image/jpeg', 'image/png', 'image/gif', 'video/mp4', 'video/mpeg', 'video/quicktime');
                if (in_array($file_type, $allowed_types)) {
                    // Create the MLS listing folder if it doesn't exist


                    // Move the uploaded file to the destination directory
                    $destination_path = $mls_listing_folder . '/' . $file_name;
                    move_uploaded_file($file_tmp, $destination_path);

                    // Store the file URL in the database
                    $file_url = 'https://gobeyondrealestate.com/assets/img/mls/' . $mlsid . '/' . $file_name;
                        } 
                }
        try {
            // Create a PDO connection
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            // Set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO listings (mlsid, price, address1, property_description, sqft, property_url, created_by, property_image)
            VALUES (:mlsid, :price, :address1, :property_description, :sqft, :property_url, :created_by,:property_image)";

            // Prepare and execute the query
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':mlsid', $mlsid);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':address1', $address1);
            $stmt->bindParam(':property_description', $property_description);
            $stmt->bindParam(':sqft', $sqft);
            $stmt->bindParam(':property_url', $property_url);
            $stmt->bindParam(':created_by', $created_by);
            $stmt->bindParam(':property_image', $file_url);
            $stmt->execute();

            // Get the last inserted ID
            $lastInsertedId = $pdo->lastInsertId();

            // Check if the insertion was successful
            if ($lastInsertedId) {
                $msg[] = "Added new listing successfully!";
                header("Location: edit_listing.php?id=$lastInsertedId");
            } else {
                echo "Error";
            }
        } catch (PDOException $e) {
            echo '' . $e->getMessage();
        }
    } else {
        // Output errors
        foreach ($err as $error) {
            $err[] = $error . "<br>";
        }
    }
}

*/
if (isset($_POST["doAdd"]) && $_POST["doAdd"] == 'Add') {
    if (empty($_POST['mlsid'])) {
        $err[] = "MLS ID cannot be blank";
    }
    
    if (empty($_POST['price'])) {
        $err[] = "Price cannot be blank";
    }
    
    if (empty($_POST['address1'])) {
        $err[] = "Address1 cannot be blank";
    }
    
    if (empty($_POST['description'])) {
        $err[] = "Property Description cannot be blank";
    }
    
    if (empty($_POST['sqft'])) {
        $err[] = "Area / SQFT cannot be blank";
    }
    
    if (empty($_POST['property_url'])) {
        $err[] = "Property URL cannot be blank";
    }
    
    
    

    if (empty($err)) {
        $mlsid = $_POST['mlsid'];
        $price = $_POST['price'];
        $address1 = $_POST['address1'];
        $property_description = $_POST['description'];
        $sqft = $_POST['sqft'];
        $property_url = $_POST['property_url'];
        $created_by = $user->data()->username;
        $status = $_POST['status'];

        $mls_listing_folder = $mls_img_upload . "/" . $mlsid;

        // Check if the directory doesn't exist, then create it
        if (!is_dir($mls_listing_folder)) {
            // The third parameter (true) specifies recursive creation, creating all necessary directories
            mkdir($mls_listing_folder, 0777, true);
        }

        // File upload handling
        $file_name = $_FILES['property_image']['name'];
        $file_tmp = $_FILES['property_image']['tmp_name'];
        $file_type = $_FILES['property_image']['type'];

        // Validate file type to allow images and videos only
        $allowed_types = array('image/jpeg', 'image/png', 'image/gif', 'video/mp4', 'video/mpeg', 'video/quicktime');
        if (in_array($file_type, $allowed_types)) {
            // Move the uploaded file to the destination directory
            $destination_path = $mls_listing_folder . '/' . $file_name;
            move_uploaded_file($file_tmp, $destination_path);

            // Store the file URL in the database
            $file_url = 'https://gobeyondrealestate.com/assets/img/mls/' . $mlsid . '/' . $file_name;

            try {
                // Create a PDO connection
                $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

                // Set the PDO error mode to exception
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "INSERT INTO listings (mlsid, price, address1, property_description, sqft, property_url, created_by, status, property_image)
                VALUES (:mlsid, :price, :address1, :property_description, :sqft, :property_url, :created_by, :status, :file_url)";

                // Prepare and execute the query
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':mlsid', $mlsid);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':address1', $address1);
                $stmt->bindParam(':property_description', $property_description);
                $stmt->bindParam(':sqft', $sqft);
                $stmt->bindParam(':property_url', $property_url);
                $stmt->bindParam(':created_by', $created_by);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':file_url', $file_url);
                $stmt->execute();

                // Get the last inserted ID
                $lastInsertedId = $pdo->lastInsertId();

                // Check if the insertion was successful
                if ($lastInsertedId) {
                    $msg[] = "Added new listing successfully!";
                    header("Location: edit_listing.php?id=$lastInsertedId");
                    exit(); // Important to exit after redirection
                } else {
                    echo "Error";
                }
            } catch (PDOException $e) {
                echo '' . $e->getMessage();
            }
        } else {
            $err[] = "Invalid file type. Allowed types: image/jpeg, image/png, image/gif, video/mp4, video/mpeg, video/quicktime";
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

            <?php

            foreach ($err as $error) {

                echo '<div class="alert alert-success text-center" role="alert">' . $error . '</div>';
            }
            ?>


            <div class="page-content">
                <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                    <div>
                        <h4 class="mb-3 mb-md-0">ADD MLS ID</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">ADD NEW MLS ID</h6>
                                <form class="forms-listing" method="POST" action="">
                                    <div class="mb-3">
                                        <label for="mlsid" class="form-label">MLS ID</label>
                                        <input type="text" class="form-control text-danger" name="mlsid" id="mlsid" placeholder="R123123" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" class="form-control text-danger" name="price" id="price" placeholder="619,000" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address1" class="form-label">Address 1</label>
                                        <input type="text" class="form-control text-danger" id="address1" name="address1" " required>
                                    </div>
                                    <div class=" mb-3">
                                        <label for="property_image" class="form-label">Property Image</label>
                                        <input type="file" class="form-control" name="property_image" id="property_image" accept="image/*" required>
                                    </div>
                                    <div class=" mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control text-danger" id="description" name="description" row="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sqft" class="form-label">Area / Sq.Ft</label>
                                        <input type="text" class="form-control text-danger" id="sqft" name="sqft">
                                    </div>
                                    <div class="mb-3">
                                        <label for="property_url" class="form-label">Property URL</label>
                                        <input type="text" class="form-control text-danger" id="property_url" name="property_url">
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control text-danger">
                                            <option value="ACTIVE">Active</option>
                                            <option value="SOLD">Sold</option>
                                            <option value="DELETED">Deleted</option>
                                            <option value="INACTIVE">Inactive</option>
                                        </select>
                                    </div>
                                    <input type="submit" name="doAdd" id="doAdd" value="Add" class="btn btn-success" />

                                </form>
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