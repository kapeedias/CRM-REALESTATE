<?php
require_once 'core/init.php';
require_once 'classes/Listings.php';
$listingz = new Listing();
$user = new User();

if (!$user->isLoggedIn()) {
    Redirect::to('login.php');
    die();
}

if (isset($_GET['id'])) {
    $lid = $_GET['id'];
}
$publicHtmlPath = dirname(__DIR__);
$mls_img_upload = $publicHtmlPath . "/assets/img/mls";

$editlisting = $listingz->getlisting($lid);

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check(
            $_POST,
            array(
                'lid' => array('required' => true),
                'price' => array('required' => true),
                'address1' => array('required' => true),
                'description' => array('required' => true),
                'sqft' => array('required' => true),
                'property_url' => array('required' => true)
            )
        );
        if ($validation->passed()) {
            $listing = new Listing();

            //Image upload logic
            $mls_listing_folder = $mls_img_upload . "/" . $mlsid;
            if (!is_dir($mls_listing_folder)) {
                mkdir($mls_listing_folder, 0777, true);
            }
            $file_name = $_FILES['property_image']['name'];
            $file_tmp = $_FILES['property_image']['tmp_name'];
            $file_type = $_FILES['property_image']['type'];
            
            if (!empty($file_name = $_FILES['property_image']['name'])) {
                $destination_path = $mls_listing_folder . '/' . $file_name;
                move_uploaded_file($file_tmp, $destination_path);
                $file_url = 'https://gobeyondrealestate.com/assets/img/mls/' . $mlsid . '/' . $file_name;
            }else{
                $file_url = $current_image;
            }
    
            try {
                $listing->update(array(
                    'price' => Hash::make(Input::get('price'), $salt),
                    'address1' => Input::get('address1'),
                    'description' => Input::get('description'),
                    'sqft' => Input::get('sqft'),
                    'property_url' => Input::get('property_url'),
                    'property_image' => $file_url,
                ),Input::get('lid'));
                Session::flash('edit_listing', 'You are registered successfully. You can login now!');
                Redirect::to('edit_listing.php?id=$lid');
            } catch (Exception $e) {
                Session::flash('Error', $e->getMessage() . '<br />');
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
                                <h4 class="mb-3 mb-md-0">MLSID: <?php echo $editlisting->mlsid; ?></h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                if (Session::exists('edit_listing')) {
                                    echo '<div class="alert alert-success text-center" role="alert">' . Session::flash('home') . '</div>';
                                }
                                ?>
                                <div class="card">
                                    <div class="card-body">

                                        <h6 class="card-title">MLSID: <?php echo $editlisting->mlsid; ?></h6>

                                        <form class="forms-listing" method="POST" action="" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="price" class="form-label">Price</label>
                                                <input type="hidden" name="lid" id="lid" value="<?php echo $editlisting->id; ?>">
                                                <input type="hidden" name="mlsid" id="mlsid" value="<?php echo $editlisting->mlsid; ?>">
                                                <input type="hidden" name="current_image" id="current_image" value="<?php echo $editlisting->property_image; ?>">
                                                <input type="text" class="form-control text-danger" name="price" id="price" value="<?php echo $editlisting->price; ?>" placeholder="619,000" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="address1" class="form-label">Address 1</label>
                                                <input type="text" class="form-control text-danger" id="address1" name="address1" value="<?php echo $editlisting->address1; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control text-danger" id="description" name="description" row="3" required><?php echo $editlisting->property_description; ?></textarea>
                                            </div>
                                            <div class=" mb-3">
                                                <label for="property_image" class="form-label">Property Image</label>
                                                <input type="file" class="form-control" name="property_image" id="property_image" accept="image/*">
                                            </div>
                                            <div class="mb-3">
                                                <label for="sqft" class="form-label">Area / Sq.Ft</label>
                                                <input type="text" class="form-control text-danger" id="sqft" name="sqft" value="<?php echo $editlisting->sqft; ?>">
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="beds" class="form-label">Beds</label>
                                                        <input type="text" class="form-control text-danger" id="beds" name="beds" value="<?php echo $editlisting->beds; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="bath" class="form-label">Bath</label>
                                                        <input type="text" class="form-control text-danger" id="bath" name="bath" value="<?php echo $editlisting->bath; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="property_url" class="form-label"><a href="<?php echo $editlisting->property_url; ?>" target="_blank">Property URL</a></label>
                                                <input type="text" class="form-control text-danger" id="property_url" name="property_url" value="<?php echo $editlisting->property_url; ?>">
                                            </div>

                                            
                                            <input type="submit" name="doUpdate" id="doUpdate" value="Update" class="btn btn-success" />

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong>Featured Image</strong>
                                <img src="<?php echo $editlisting->property_image; ?>" style="max-width: 500px;" />
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