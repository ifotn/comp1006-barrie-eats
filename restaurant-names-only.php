<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Names</title>
</head>
<body>
<?php

// connect
$db = new PDO('mysql:host=localhost;dbname=barrieEats', 'root', '');

// set up the query
$sql = "SELECT name FROM restaurants";
$cmd = $db->prepare($sql);

// fetch the data from the db
$cmd->execute();
$restaurants = $cmd->fetchAll();

// loop through the data and print 1 record at a time
foreach ($restaurants as $r) {
    echo $r['name'] . "<br />" ;
}

// disconnect
$db = null;

?>
</body>
</html>
