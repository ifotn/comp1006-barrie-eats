<?php

// access the current session then kill it
session_start();

session_destroy();

header('location:login.php');
?>
