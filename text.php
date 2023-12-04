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

// Replace these variables with your database credentials
$servername = "localhost";
$username = "cms_admin";
$password = "cQ&cH_k)Xybr";
$dbname = "cms_livewd";

if (isset($_POST["doAdd"]) && $_POST["doAdd"] == 'Add') {
    // Validate input fields
    $requiredFields = array('mlsid', 'price', 'address1', 'description', 'sqft', 'property_url');

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $err[] = ucfirst($field) . " cannot be blank";
        }
    }

    // File upload handling
    if (!empty($_FILES['property_image']['name'])) {
        $file_name = $_FILES['property_image']['name'];
        $file_tmp = $_FILES['property_image']['tmp_name'];
        $file_type = $_FILES['property_image']['type'];

        // Validate file type to allow images and videos only
        $allowed_types = array('image/jpeg', 'image/png', 'image/gif', 'video/mp4', 'video/mpeg', 'video/quicktime');
        if (in_array($file_type, $allowed_types)) {
            // Create the MLS listing folder if it doesn't exist
            $mlsid = $_POST['mlsid'];
            $mls_listing_folder = $mls_img_upload . "/" . $mlsid;
            if (!is_dir($mls_listing_folder)) {
                mkdir($mls_listing_folder, 0777, true);
            }

            // Move the uploaded file to the destination directory
            $destination_path = $mls_listing_folder . '/' . $file_name;
            move_uploaded_file($file_tmp, $destination_path);

            // Store the file URL in the database
            $file_url = 'assets/img/mls/' . $mlsid . '/' . $file_name;
            // Add the file_url to the SQL query
            $sql = "INSERT INTO listings (mlsid, price, address1, property_description, sqft, property_url, created_by, property_image)
            VALUES (:mlsid, :price, :address1, :property_description, :sqft, :property_url, :created_by, :file_url)";
        } else {
            $err[] = "Invalid file type. Allowed types: image/jpeg, image/png, image/gif, video/mp4, video/mpeg, video/quicktime";
        }
    } else {
        // File not uploaded, create the SQL query without property_image
        $sql = "INSERT INTO listings (mlsid, price, address1, property_description, sqft, property_url, created_by)
            VALUES (:mlsid, :price, :address1, :property_description, :sqft, :property_url, :created_by)";
    }

    // If there are no input errors, perform the update
    if (empty($err)) {
        try {
            // Create a PDO connection
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            // Set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare and execute the query
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':mlsid', $_POST['mlsid']);
            $stmt->bindParam(':price', $_POST['price']);
            $stmt->bindParam(':address1', $_POST['address1']);
            $stmt->bindParam(':property_description', $_POST['description']);
            $stmt->bindParam(':sqft', $_POST['sqft']);
            $stmt->bindParam(':property_url', $_POST['property_url']);
            $stmt->bindParam(':created_by', $user->data()->username);

            // Bind the file URL if it exists
            if (isset($file_url)) {
                $stmt->bindParam(':file_url', $file_url);
            }

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
            echo $error . "<br>";
        }
    }
}
?>
