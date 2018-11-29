<?php
// connect
require('../db.php');

// set up the query
$sql = "SELECT * FROM restaurants";

// check for an id parameter
$restaurantId = null;
$name = null;

if (isset($_GET['restaurantId'])) {
    $sql .= " WHERE restaurantId = :restaurantId";
    $restaurantId = $_GET['restaurantId'];
}

if (isset($_GET['name'])) {
    $sql .= " WHERE name = :name";
    $name = $_GET['name'];
}

// execute the query & return the results as an array
$cmd = $db->prepare($sql);

if (isset($restaurantId)) {
    $cmd->bindParam(':restaurantId', $restaurantId, PDO::PARAM_INT);
}

if (isset($name)) {
    $cmd->bindParam(':name', $name, PDO::PARAM_STR, 60);
}

$cmd->execute();
$restaurants = $cmd->fetchAll(PDO::FETCH_ASSOC);

// return the results as json
echo json_encode($restaurants);

// disconnect
$db = null;
?>