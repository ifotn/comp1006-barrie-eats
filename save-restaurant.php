<?php
require('header.php');
require('auth.php');

// introduce variables to store the form input values
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$restaurantType = $_POST['restaurantType'];
$restaurantId = $_POST['restaurantId'];
$logo = null;

// validate each input
$ok = true;

if (empty($name)) {
    echo "Name is Required.<br />";
    $ok = false;
}

if (empty($address)) {
    echo "Address is Required.<br />";
    $ok = false;
}

if (empty($phone)) {
    echo "Phone is Required.<br />";
    $ok = false;
}

if ($restaurantType == '-Select-') {
    echo "Type is Required.<br />";
    $ok = false;
}

// check and validate logo upload
if (isset($_FILES['logo'])) {
    $logoFile = $_FILES['logo'];

    if ($logoFile['size'] > 0) {
        // generate unique file name
        $logo = session_id() . "-" . $logoFile['name'];

        // check file type
        $fileType = null;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileType = finfo_file($finfo, $logoFile['tmp_name']);

        // allow only jpeg & png
        if (($fileType != "image/jpeg") && ($fileType != "image/png")) {
            echo 'Please upload a valid JPG or PNG logo<br />';
            $ok = false;
        }
        else {
            // save the file
            move_uploaded_file($logoFile['tmp_name'], "img/{$logo}");
        }
    }

}

// only save if no validation errors
if ($ok) {

    // connect to the database with server, username, password, dbname
    require('db.php');

    // set up and execute an INSERT or UPDATE command
    if (empty($restaurantId)) {
        $sql = "INSERT INTO restaurants (name, address, phone, restaurantType, logo) 
    VALUES (:name, :address, :phone, :restaurantType, :logo)";
    }
    else {
        $sql = "UPDATE restaurants SET name = :name, address = :address, phone = :phone,
restaurantType = :restaurantType, logo = :logo WHERE restaurantId = :restaurantId";
    }

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':name', $name, PDO::PARAM_STR, 60);
    $cmd->bindParam(':address', $address, PDO::PARAM_STR, 120);
    $cmd->bindParam(':phone', $phone, PDO::PARAM_STR, 15);
    $cmd->bindParam(':restaurantType', $restaurantType, PDO::PARAM_STR, 50);
    $cmd->bindParam(':logo', $logo, PDO::PARAM_STR, 100);

    if (!empty($restaurantId)) {
        $cmd->bindParam(':restaurantId', $restaurantId, PDO::PARAM_INT);
    }
    $cmd->execute();

    // disconnect
    $db = null;

    header('location:restaurants.php');
}
?>

</body>
</html>
