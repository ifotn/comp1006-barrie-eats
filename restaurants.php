<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurants</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
<a href="restaurant.php">Add a New Restaurant</a>
<h1>Restaurants</h1>

<?php
// connect
$db = new PDO('mysql:host=localhost;dbname=barrieEats', 'root', '');
//$db = new PDO('mysql:host=aws.computerstudi.es;dbname=gcxxxxxxxxx', 'gcxxxxxxxxx', 'awspass');


// set up query
$sql = "SELECT * FROM restaurants";

// execute & store the result
$cmd = $db->prepare($sql);
$cmd->execute();
$restaurants = $cmd->fetchAll();

// start the table
echo '<table class="table table-striped table-hover"><thead><th>Name</th><th>Address</th>
<th>Phone</th><th>Actions</th></thead>';

// loop through the data & show each restaurant on a new row
foreach ($restaurants as $r) {
    echo "<tr><td> {$r['name']} </td>
        <td> {$r['address']} </td>
        <td> {$r['phone']} </td>
        <td><a href=\"delete-restaurant.php?restaurantId={$r['restaurantId']}\" 
        class=\"text-danger\">Delete</a></td></tr>";
}

// close the table
echo '</table>';

// disconnect
$db = null;
?>

</body>
</html>
