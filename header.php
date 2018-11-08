<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="default.php">Barrie Eats</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="restaurants.php">Restaurants</a></li>
            <li><a href="reviews.php">Reviews</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <?php
            // access the current session
            session_start();
            if (empty($_SESSION['userId'])) {
                echo '<li><a href="register.php">Register</a></li>
                        <li><a href="login.php">Login</a></li>';
            }
            else {
                echo '<li><a href="#">' . $_SESSION['username'] . '</a></li>
                        <li><a href="logout.php">Logout</a></li>';
            }

            ?>
        </ul>
    </div>
</nav>