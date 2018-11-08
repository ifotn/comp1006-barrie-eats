<?php

// auth check
session_start();
if (empty($_SESSION['userId'])) {
    header('location:login.php');
    exit();
}

?>
