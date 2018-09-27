<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dropdown Test</title>
</head>
<body>
<?php
// connect
$db = new PDO('mysql:host=localhost;dbname=barrieEats', 'root', '');

// set up query
$sql = "SELECT name FROM restaurants ORDER BY name";

// execute & store the result in a variable
$cmd = $db->prepare($sql);
$cmd->execute();
$restaurants = $cmd->fetchAll();

// create dropdown list
echo '<select name="name">';

foreach ($restaurants as $r) {
    echo '<option>' . $r['name'] . '</option>';
}

// close list
echo '</select>';

// disconnect
$db = null;
?>
</body>
</html>
