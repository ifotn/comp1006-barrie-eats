<?php
$username = $_POST['username'];
$password = $_POST['password'];

$db = new PDO('mysql:host=localhost;dbname=barrieEats', 'root', '');

$sql = "SELECT userId, password FROM users WHERE username = :username";

$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();

$user = $cmd->fetch();

if (!password_verify($password, $user['password'])) {
    header('location:login.php?invalid=true');
    exit();
}
else {
    // the 3 missing lines go here
    session_start(); // connect to existing session so we can write to it
    $_SESSION['userId'] = $user['userId'];
    $_SESSION['username'] = $username;
    header('location:restaurants.php');
}

$db = null;

?>

