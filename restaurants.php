<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurants</title>
</head>
<body>
<h1>Restaurants</h1>

<?php
// connect
$db = new PDO('mysql:host=localhost;dbname=barrieEats', 'root', '');

// set up query
$sql = "SELECT * FROM restaurants";

// execute & store the result
$cmd = $db->prepare($sql);
$cmd->execute();
$restaurants = $cmd->fetchAll();

// start the table
echo '<table border="1"><thead><th>Name</th><th>Address</th><th>Phone</th></thead>';

// loop through the data & show each restaurant on a new row
foreach ($restaurants as $r) {
    echo '<tr><td>' . $r['name'] .
        '</td><td>' . $r['address'] .
        '</td><td>' . $r['phone'] . '</td></tr>';
}

// close the table
echo '</table>';

// disconnect
$db = null;
?>

</body>
</html>
