<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List Test</title>
</head>
<body>
<?php
// connect
$db = new PDO('mysql:host=localhost;dbname=barrieEats', 'root', '');

// set up query
$sql = "SELECT name FROM restaurants ORDER BY name";

// execute & store the result
$cmd = $db->prepare($sql);
$cmd->execute();
$restaurants = $cmd->fetchAll();

// create dropdown list
echo '<ul style="display:inline-block;">';

foreach ($restaurants as $r) {
    echo '<li><a href="#">' . $r['name'] . '</a></li>';
}

// close list
echo '</ul>';

// disconnect
$db = null;
?>
</body>
</html>
