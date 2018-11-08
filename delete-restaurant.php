<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Restaurant</title>
</head>
<body>

<?php
require('auth.php');

// GET selected restaurantId
$restaurantId = $_GET['restaurantId'];

if (empty($restaurantId)) {
    header('location:restaurants.php');
}

// connect
require('db.php');

// set up and execute SQL DELETE command
$sql = "DELETE FROM restaurants WHERE restaurantId = :restaurantId";
$cmd = $db->prepare($sql);
$cmd->bindParam(':restaurantId', $restaurantId, PDO::PARAM_INT);
$cmd->execute();

// disconnect
$db = null;

// redirect to updated restaurants page
header('location:restaurants.php');

?>

</body>
</html>
