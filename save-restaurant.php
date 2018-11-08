<?php
require('header.php');
require('auth.php');

// introduce variables to store the form input values
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$restaurantType = $_POST['restaurantType'];
$restaurantId = $_POST['restaurantId'];

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

// only save if no validation errors
if ($ok) {
    // connect to the database with server, username, password, dbname
    require('db.php');

    // set up and execute an INSERT or UPDATE command
    if (empty($restaurantId)) {
        $sql = "INSERT INTO restaurants (name, address, phone, restaurantType) 
    VALUES (:name, :address, :phone, :restaurantType)";
    }
    else {
        $sql = "UPDATE restaurants SET name = :name, address = :address, phone = :phone,
restaurantType = :restaurantType WHERE restaurantId = :restaurantId";
    }

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':name', $name, PDO::PARAM_STR, 60);
    $cmd->bindParam(':address', $address, PDO::PARAM_STR, 120);
    $cmd->bindParam(':phone', $phone, PDO::PARAM_STR, 15);
    $cmd->bindParam(':restaurantType', $restaurantType, PDO::PARAM_STR, 50);

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
