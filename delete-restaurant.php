<?php
require('header.php');
require('auth.php');

// GET selected restaurantId
$restaurantId = $_GET['restaurantId'];

if (empty($restaurantId)) {
    header('location:restaurants.php');
}

// connect
require('db.php');

// find logo & delete it if there is one
$sql = "SELECT logo FROM restaurants WHERE restaurantId = :restaurantId";
$cmd = $db->prepare($sql);
$cmd->bindParam(':restaurantId', $restaurantId, PDO::PARAM_INT);
$cmd->execute();
$logo = $cmd->fetchColumn();

// set up and execute SQL DELETE command
$sql = "DELETE FROM restaurants WHERE restaurantId = :restaurantId";
$cmd = $db->prepare($sql);
$cmd->bindParam(':restaurantId', $restaurantId, PDO::PARAM_INT);
$cmd->execute();

// disconnect
$db = null;

// now delete logo if there is one
if (isset($logo)) {
    unlink("img/$logo");
}

// redirect to updated restaurants page
header('location:restaurants.php');

?>

</body>
</html>
