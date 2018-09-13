<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
// take the value from each form input and store in a variable
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];

echo "$firstName $lastName<br />";
echo $email;

?>

</body>
</html>
