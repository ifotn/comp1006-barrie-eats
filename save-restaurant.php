<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save Restaurant</title>
</head>
<body>

<?php
// introduce variables to store the form input values
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$restaurantType = $_POST['restaurantType'];

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

// only save if no validation errors
if ($ok) {
    // connect to the database with server, username, password, dbname
    $db = new PDO('mysql:host=localhost;dbname=barrieEats', 'root', '');

    // set up and execute an INSERT command
    $sql = "INSERT INTO restaurants (name, address, phone, restaurantType) 
    VALUES (:name, :address, :phone, :restaurantType)";

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':name', $name, PDO::PARAM_STR, 60);
    $cmd->bindParam(':address', $address, PDO::PARAM_STR, 120);
    $cmd->bindParam(':phone', $phone, PDO::PARAM_STR, 15);
    $cmd->bindParam(':restaurantType', $restaurantType, PDO::PARAM_STR, 50);
    $cmd->execute();

    // disconnect
    $db = null;

    echo "Restaurant Saved";
}
?>

</body>
</html>
