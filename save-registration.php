<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving your Registration</title>
</head>
<body>

<?php
// store form inputs in variables
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

// validate inputs
if (empty($username)) {
    echo 'Username is required<br />';
    $ok = false;
}

if (strlen($password) < 8) {
    echo 'Password is invalid<br />';
    $ok = false;
}

if ($password != $confirm) {
    echo 'Passwords do not match<br />';
    $ok = false;
}

// check recaptcha
$secret = "6Le-6X0UAAAAAMfwNNXfElf-oljma9L3szc0inwR";
$response = $_POST["g-recaptcha-response"];

// make hidden request to google using the PHP CURL library
$request = curl_init();
curl_setopt($request, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
curl_setopt($request, CURLOPT_POST, true);

// create an array to pass the request values to google
$postData = array();
$postData['secret'] = $secret;
$postData['response'] = $response;
curl_setopt($request, CURLOPT_POSTFIELDS, $postData);

// execute the api call and check the response
$googleResponse = curl_exec($request);
curl_close($request);

$googleResponse = json_decode($googleResponse, true);
if ($googleResponse['success'] != 1) {
    echo "Are you human?<br />";
    $ok = false;
}

if ($ok) {
    // hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // connect
    require('db.php');

    // set up & execute the insert
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->bindParam(':password', $hashedPassword, PDO::PARAM_STR, 255);
    $cmd->execute();

    // disconnect
    $db = null;

    // redirect to login
    header('location:login.php');
}
?>

</body>
</html>
